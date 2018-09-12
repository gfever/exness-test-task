<?php

namespace App\Listeners;

use App\Events\TransferCreated;
use App\Transaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTransfer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransferCreated  $event
     * @return void
     */
    public function handle(TransferCreated $event)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->user_id = $event->transfer->sender_id;
        $transaction->operation = Transaction::OPERATION_DEDUCT;
        $transaction->save();

        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->user_id = $event->transfer->recipient_id;
        $transaction->operation = Transaction::OPERATION_ADD;
        $transaction->save();
    }
}
