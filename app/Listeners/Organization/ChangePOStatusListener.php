<?php

namespace App\Listeners\Organization;

use App\Events\Organization\ChangePOStatusEvent;
use Organization\Models\PoStatusHistory;

class ChangePOStatusListener
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
     * @param  ChangePOStatusEvent  $event
     * @return void
     */
    public function handle(ChangePOStatusEvent $event)
    {
        $po     = $event->po_id;
        $status = $event->status_id;
        PoStatusHistory::create([
            'purchase_order_id'=>$po,
            'status_id'=>$status,
            'organization_admin_id'=>auth('organization_admin')->user()->id,
        ]);
    }
}
