<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UserStore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * @param StoreUser $storeUser
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreUser $storeUser)
    {
        $currency = Currency::where('code', '=', $storeUser->currency_code)->firstOrFail();
        $user = resolve(User::class);
        $user->fill($storeUser->except(['currency_code', 'password']));
        $user->currency_id = $currency->id;
        $user->password = Hash::make($storeUser->password);
        $user->save();

        return response('User registered');
    }

}
