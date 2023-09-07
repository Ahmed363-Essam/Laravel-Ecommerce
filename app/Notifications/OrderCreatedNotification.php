<?php

namespace App\Notifications;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $order;
    public function __construct( order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        // determine user channer
        $channel = ['mail','database'];

     
        return $channel;   //return ['mail' ,'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $adr = $this->order->addrress;
        return (new MailMessage)
        ->subject('new object is crested number #' . $this->order->number )
        ->line('A new Order Is Created # '.$this->order->number .'created by '.$this->order->number . 'Country Is'.$this->order->number )
        ->greeting("HI , {$notifiable->name}")
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return
        [
            'body'=>'A new Order Is Created By'. $notifiable->name,
            'icon'=>'fas fa-file',
            'url'=>url('dashboard/dashboard'),
            'order_number'=>$this->order->number,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
