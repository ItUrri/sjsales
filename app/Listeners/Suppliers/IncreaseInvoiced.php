<?php

namespace App\Listeners\Suppliers;

use App\Events\MovementEvent,
    App\Entities\Supplier\Invoiced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseInvoiced
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
     * @param  \App\Events\MovementEvent  $event
     * @return void
     */
    public function handle(MovementEvent $event)
    {
        $movement = $event->entity;
        $order    = $movement->getOrder();
        $products = $order->getProducts();
        $year     = (int) $order->getDate()->format("Y");
        foreach ($products as $product) {
            $supplier = $product->getSupplier();
            if (null === ($invoiced = $supplier->getInvoiced($year))) {
                $invoiced = new Invoiced;
                $invoiced->setYear($year); 
                $supplier->addInvoiced($invoiced);
            }
            $invoiced->increaseCredit($order->getCredit());
            break;
        }
    }
}
