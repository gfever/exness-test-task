<?php

namespace App\Events;

use App\Transfer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class TransferCreated
 * @package App\Events
 *
 * @property Transfer $transfer
 */
class TransferCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $transfer;

    /**
     * TransferCreated constructor.
     * @param Transfer $transfer
     */
    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }
}
