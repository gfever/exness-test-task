<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transfer
 * @package App
 *
 * @property int $sender_id
 * @property-read  \App\User $sender
 * @property int $recipient_id
 * @property-read  \App\User $recipient
 * @property int $currency_id
 * @property-read  \App\Currency currency
 * @property float $amount
 */
class Transfer extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
