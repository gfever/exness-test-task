<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;


use App\Converter\Converter;
use App\Http\Requests\ListTransactions;
use App\Models\Transaction;
use App\Models\User;

class ReportController extends Controller
{

    public function userTransactions(ListTransactions $listTransactions)
    {
        $transactions = [];
        /** @var User $user */
        $user = resolve(User::class)->where('name', '=', $listTransactions->user_name)->first();
        $sunInUsd = 0;
        $sumInUserCurrency = 0;
        if ($user) {
            $builder = $user->transactions();

            if (!empty($listTransactions->from_date)) {
                $builder->where('created_at', '>=', $listTransactions->from_date . ' 00:00:00');
            }

            if (!empty($listTransactions->to_date)) {
                $builder->where('created_at', '<=', $listTransactions->to_date . ' 23:59:59');
            }

            $transactions = $builder->get();

            if ($transactions->count() > 0) {
                if (!empty($listTransactions->download)) {
                    $pathToFile = "/tmp/report_{$user->id}.csv";
                    $fp = fopen($pathToFile, 'w');

                    $transactions = $transactions->toArray();
                    foreach ($transactions as $transaction) {
                        fputcsv($fp, $transaction);
                    }

                    fclose($fp);
                    return response()->download($pathToFile)->deleteFileAfterSend(true);
                }

                $sumInUserCurrency = $transactions->where('operation', '=', Transaction::OPERATION_ADD)->sum('amount') - $transactions->where('operation', '=', Transaction::OPERATION_DEDUCT)->sum('amount');

                /** @var Converter $converter */
                $converter = resolve(Converter::class);
                try {
                    $sunInUsd = $converter->convertFromTo($user->currency->code, 'USD', $sumInUserCurrency);
                } catch (\Exception $exception) {
                    return response($exception->getMessage(), 400);
                }
            }
        }

        return view('report', compact('transactions', 'sumInUserCurrency', 'sunInUsd'));
    }

}
