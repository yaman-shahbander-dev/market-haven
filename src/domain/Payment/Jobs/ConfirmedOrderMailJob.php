<?php

namespace Domain\Payment\Jobs;

use Domain\Order\Models\Order;
use Domain\Payment\Mail\OrderConfirmedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ConfirmedOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Order $order) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->email)->send(new OrderConfirmedMail($this->order));
    }
}
