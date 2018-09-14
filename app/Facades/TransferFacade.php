<?php
/**
 * @author d.ivaschenko
 */

namespace App\Facades;


use App\Converter\Converter;
use App\Models\Transaction;
use App\Models\Transfer;

/**
 * Class TransferFacade
 * @package App\Facades
 *
 * @property-read Transfer $transfer
 */
class TransferFacade
{
    /** @var Transfer */
    private $transfer;
    /** @var Converter */
    private $converter;

    /**
     * TransferFacade constructor
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
        \DB::transaction(function () {
            $this->makeTransaction(Transaction::OPERATION_DEDUCT);
            $this->makeTransaction(Transaction::OPERATION_ADD);
        });
    }

    /**
     * @param string $operation
     * @throws \Exception
     */
    private function makeTransaction(string $operation): void
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

        $transaction->process();
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getSenderAmount(): float
    {
        return $this->converter->convertFromTo($this->transfer->currency->code, $this->transfer->sender->currency->code, $this->transfer->amount);
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getRecipientAmount(): float
    {
        return $this->converter->convertFromTo($this->transfer->currency->code, $this->transfer->recipient->currency->code, $this->transfer->amount);
    }
}
