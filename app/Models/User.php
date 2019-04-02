<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package App
 *
 * @property int        $id
 * @property int        $currency_id
 * @property string     $country
 * @property string     $city
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property float      $balance
 * @property Currency   $currency
 * @property Collection $transactions
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
            'city',
            'country',
            'currency_id'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }


    public function getCurrentBalance()
    {
        $results = \DB::select(\DB::raw("SELECT amount FROM transactions WHERE user_id={$this->id}"));
    }
}
