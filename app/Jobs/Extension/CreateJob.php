<?php

namespace App\Jobs\Extension;

use App\Enums\OrderStatus;
use App\Models\Order;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    protected array $retryDelays = [60, 120];

    public function __construct(public Order $order){}

    public function handle(): void
    {
        try {
            $this->order->first()->extension()->first()->getClass()->create($this->order->user()->first(), $this->order->first());
            
            $this->order->first()->update([
                'status' => OrderStatus::Completed
            ]);
            
            $this->delete();
        } catch (Exception $e) {
            if ($this->attempts() < $this->tries) {
                $delay = $this->retryDelays[$this->attempts() - 1];
                $this->release($delay);
            } else {
                $this->order->first()->update([
                    'status' => OrderStatus::Failed
                ]);
                
                $this->fail($e);
            }
        }
    }

    public function backoff(): int
    {
        return $this->retryDelays[$this->attempts() - 1];
    }
}
