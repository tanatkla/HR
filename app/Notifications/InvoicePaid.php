<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;
 
    private $invoiceData;
     
    public function __construct($invoiceData)
    {
        $this->invoiceData = $invoiceData;
    }
     
    public function via($notifiable)
    {
        return ['mail','database'];
    }
     
    public function toMail($notifiable)
    {
        return (new MailMessage)                    
            ->name($this->invoiceData['title'])
            ->line($this->invoiceData['body'])
            ->action($this->invoiceData['buttonText'], $this->invoiceData['invoiceUrl'])
            ->line($this->invoiceData['thanks']);
    }
     
    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->invoiceData['id']
        ];
    }
}
