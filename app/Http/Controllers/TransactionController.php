<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListTransactions;
use App\Http\Requests\StoreTransaction;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function index(ListTransactions $listTransactions)
    {

    }


    public function store(StoreTransaction $storeTransaction)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->fill($storeTransaction->all());
        $transaction->save();

        return response('Transaction created');
    }
}
