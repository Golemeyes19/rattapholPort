<?php

namespace Modules\ContactUs\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactForm
{
    use SerializesModels, Dispatchable;

    public $contact;
    public $contact_detail;
    public $action='contact-form';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($contact,$contact_detail)
    {
        $this->contact = $contact ;
        $this->contact_detail = $contact_detail ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('contact-form');
    }
}
