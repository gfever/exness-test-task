<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;


class ReportController extends Controller
{

    public function userTransactions()
    {
        return view('report');
    }

}