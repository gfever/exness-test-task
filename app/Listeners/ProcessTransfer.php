<?php

namespace App\Listeners;

use App\Events\TransferCreated;
use App\Facades\TransferFacade;
use App\Transaction;
use App\Transfer;
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
     * @param TransferCreated $event
     * @throws \Exception
     */
    public function handle(TransferCreated $event)
    {
        /** @var TransferFacade $transferFacade */
        $transferFacade = resolve(TransferFacade::class);
        $transferFacade->setTransfer($event->transfer);
        $transferFacade->process();
    }
}
