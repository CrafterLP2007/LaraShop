<?php

namespace App\Jobs\Extension;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefundJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    protected array $retryDelays = [60, 120];

    public function __construct(public Order $order){
        $this->tries = config('order.jobs.refund.tries');
        $this->retryDelays = config('order.jobs.refund.delays');
        $this->queue = config('order.jobs.refund.queue');
    }

    public function handle(): void
    {
    }
}
