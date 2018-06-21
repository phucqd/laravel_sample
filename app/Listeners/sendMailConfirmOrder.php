<?php

namespace App\Listeners;

use App\Events\customerOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\SubmitOrderMail;
use App\Mail\ ReportFailerMail;

class sendMailConfirmOrder implements ShouldQueue
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
     * @param  customerOrder  $event
     * @return void
     */
    public function handle(customerOrder $event)
    {
        Mail::to($event->bill->customer->email)->send(new SubmitOrderMail($event->bill->customer, $event->bill));
    }

    public function failed(customerOrder $event, $exception)
    {
        //Mail::to('xdangminhtruongx@gmail.com')->send(new ReportFailerMail());
    }
}
