<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;


use App\Http\Requests\WalletAdd;
use App\Models\Transaction;

class WalletController extends Controller
{
    /**
     * @param WalletAdd $walletAdd
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function add(WalletAdd $walletAdd)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->fill($walletAdd->all());
        $transaction->operation = Transaction::OPERATION_ADD;
        $transaction->process();

        return response('Balance updated');
    }
}