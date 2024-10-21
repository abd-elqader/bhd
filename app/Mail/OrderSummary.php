<?php

namespace App\Mail;

use App\Models\Tenant\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $Order;

    public function __construct(Order $Order)
    {
        $this->Order = $Order;
    }

    public function build()
    {
        return $this->view('emails.order_summary');
    }
}
