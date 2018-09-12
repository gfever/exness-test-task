<?php
/**
 * @author d.ivaschenko
 */

namespace App\Facades;


use App\Transaction;
use App\Transfer;

/**
 * Class TransferFacade
 * @package App\Facades
 *
 * @property-read Transfer $transfer
 */
class TransferFacade
{
    private $transfer;

    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }


    private function makeTransaction(string $operation)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->user_id = $operation === Transaction::OPERATION_DEDUCT ? $this->transfer->sender_id : $this->transfer->recipient_id;
        $transaction->operation = $operation;

        $transaction->save();
    }
}