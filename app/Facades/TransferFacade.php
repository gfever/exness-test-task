<?php
/**
 * @author d.ivaschenko
 */

namespace App\Facades;


use App\Converter\Converter;
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
    /** @var Converter  */
    private $converter;

    /**
     * TransferFacade constructor.
     * @param Transfer $transfer
     * @throws \Exception
     */
    public function __construct()
    {
        $this->converter = resolve(Converter::class);
    }

    /**
     * @param Transfer $transfer
     */
    public function setTransfer(Transfer $transfer): void
    {
        $this->transfer = $transfer;
    }

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        $this->makeTransaction(Transaction::OPERATION_ADD);
        $this->makeTransaction(Transaction::OPERATION_DEDUCT);
        
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    public function getSenderAmount()
    {
        return $this->converter->convertFromTo($this->transfer->currency->code, $this->transfer->sender->currency->code, $this->transfer->amount);
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    public function getRecipientAmount()
    {
        return $this->converter->convertFromTo($this->transfer->currency->code, $this->transfer->recipient->currency->code, $this->transfer->amount);
    }


    /**
     * @param string $operation
     * @throws \Exception
     */
    private function makeTransaction(string $operation)
    {
        /** @var Transaction $transaction */
        $transaction = resolve(Transaction::class);
        $transaction->user_id = $operation === Transaction::OPERATION_DEDUCT ? $this->transfer->sender_id : $this->transfer->recipient_id;
        $transaction->operation = $operation;

        if ($operation === Transaction::OPERATION_DEDUCT) {
            $transaction->amount = $this->getSenderAmount();
        } else {
            $transaction->amount = $this->getRecipientAmount();
        }

        $transaction->save();
    }
}