<?php

namespace Modules\ContactUs\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyContactForm extends Notification
{
    use Queueable;
    public $contact_detail ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact_detail)
    {
        $this->contact_detail = $contact_detail ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->contact_detail['subject'])
                    ->markdown('emails.contacts.contact_us',['contact_detail'=>$this->contact_detail])
                    ->cc($this->contact_detail['cc_email']);
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}