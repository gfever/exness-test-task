<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListTransactions;
use App\Http\Requests\StoreTransaction;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @param ListTransactions $listTransactions
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(ListTransactions $listTransactions)
    {
        /** @var User $user */
        $user = resolve(User::class)->where('name', '=', $listTransactions->user_name)->first();
        return $user->transactions;
    }


    /**
     * @param StoreTransaction $storeTransaction
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreTransaction $storeTransaction)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->fill($storeTransaction->all());
        $transaction->save();

        return response('Transaction created');
    }
}
