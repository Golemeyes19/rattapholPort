<?php

namespace Modules\ContactUs\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Notification;

use Modules\ContactUs\Notifications\NotifyContactForm ;

class ContactEventSubscriber
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
    * Function : listen order confirm
    * Dev : Tong
    * Update Date : 4 Nov 2021
    * @param no
    * @return null
    */
    public function handleContactForm($event) {
        //mwz_pre($event->contact); exit;
        $noti = Notification::send($event->contact, new NotifyContactForm($event));
    }

    /**
    * Function : subscribe user event and handler
    * Dev : Tong
    * Update Date : 19 Jul 2021
    * @param no
    * @return no
    */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\ContactUs\Events\ContactForm',
            [ContactEventSubscriber::class, 'handleContactForm']
        );
    }
}
