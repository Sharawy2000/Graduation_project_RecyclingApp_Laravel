<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\ConfirmationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    /**
     * Create a new job instance.
     *
     * @param int $orderId
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $confirmation = ConfirmationNotification::where('order_id', $this->orderId)->first();

            if ($confirmation && !$confirmation->seller_response && !$confirmation->buyer_response) {
                $order->delete();
                ConfirmationNotification::where('order_id', $this->orderId)->delete();
            }
        }
    }
}
