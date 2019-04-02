<?php

namespace App\Http\Controllers;

use App\Facades\TransferFacade;
use App\Http\Requests\StoreTransfer;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\User;

class TransferController extends Controller
{
    /**
     * @param StoreTransfer $storeTransfer
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreTransfer $storeTransfer)
    {
        /** @var User $user */
        $user = resolve(User::class);
        /** @var User $sender */
        $sender = $user->find($storeTransfer->sender_id);
        if ($storeTransfer->sender_password !== $sender->password) {
            return response('Wrong password', 401);
        }
        /** @var User $recipient */
        $recipient = $user->find($storeTransfer->recipient_id);

        /** @var Currency $transferCurrency */
        $transferCurrency = resolve(Currency::class)->whereCode($storeTransfer->currency_code)->firstOrFail();

        $availableCurrencies = array_unique([$sender->currency->code, $recipient->currency->code]);
        if (!\in_array($storeTransfer->currency_code, $availableCurrencies, true)) {
            return response('Can transfer only in ' . implode(',', $availableCurrencies), 400);
        }

        /** @var Transfer $transfer */
        $transfer = resolve(Transfer::class);
        $transfer->fill($storeTransfer->except('currency_code'));
        $transfer->currency_id = $transferCurrency->id;
        $transfer->save();

        /** @var TransferFacade $transferFacade */
        $transferFacade = resolve(TransferFacade::class);
        $transferFacade->setTransfer($transfer);

        try {
            $transferFacade->process();
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return response('Transfer created', 200);
    }
}
