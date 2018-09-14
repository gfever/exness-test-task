<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListTransactions;
use App\Models\User;

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

}
