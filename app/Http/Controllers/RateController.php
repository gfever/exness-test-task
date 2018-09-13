<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;


use Fadion\Fixerio\Exchange;

class RateController extends Controller
{

    public function update()
    {
        $rates = (new Exchange())->key(config('currencies.fixerio_acces_key'))->get();
        dd($rates);
    }
    
}