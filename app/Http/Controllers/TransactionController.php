<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListTransactions;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * @param ListTransactions $listTransactions
     *
     * @return array
     */
    public function index(ListTransactions $listTransactions)
    {
        /** @var User $user */
        $user = resolve(User::class)->where('name', '=', $listTransactions->user_name)->first();

        $builder = $user->transactions();

        if (!empty($listTransactions->from_date)) {
            $builder->where('created_at', '>=', $listTransactions->from_date . ' 00:00:00');
        }

        if (!empty($listTransactions->to_date)) {
            $builder->where('created_at', '<=', $listTransactions->to_date . ' 23:59:59');
        }

        return ['data' => $builder->get()];
    }

}
