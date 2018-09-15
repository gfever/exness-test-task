<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UserStore;
use App\Models\Currency;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @param StoreUser $storeUser
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreUser $storeUser)
    {
        $currency = resolve(Currency::class)->where('code', '=', $storeUser->currency_code)->firstOrFail();
        $user = resolve(User::class);
        $user->fill($storeUser->except(['currency_code', 'password']));
        $user->currency_id = $currency->id;
        $user->password = $storeUser->password;
        $user->save();

        return response($user);
    }

}
