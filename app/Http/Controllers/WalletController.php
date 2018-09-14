<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;


use App\Http\Requests\WalletAdd;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WalletController extends Controller
{
    /**
     * @param WalletAdd $walletAdd
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function add(WalletAdd $walletAdd, User $user)
    {
        $t = Hash::make($walletAdd->password);
        if ($user->password !== $walletAdd->password) {
            return response('Wrong password', 401);
        }
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->amount = $walletAdd->amount;
        $transaction->user_id = $user->id;
        $transaction->operation = Transaction::OPERATION_ADD;
        $transaction->process();

        return response('Balance updated');
    }
}
