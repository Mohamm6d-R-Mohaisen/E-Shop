<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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
        //$notifiable : تمثل الاوبجكت من مودل اليوزر (اليوزر الي هترسل له الاشعار )
        //يتم تمريره ليتيح للمستخدم اختيار القناة التي سترسل عليها الاشعارات
    {
        return ['mail'];

        $channels = ['database'];
        if ($notifiable->notification_preferences['order_created']['sms'] ?? false) {
            $channels[] = 'vonage';
        }
        if ($notifiable->notification_preferences['order_created']['mail'] ?? false) {
            $channels[] = 'mail';
        }
        if ($notifiable->notification_preferences['order_created']['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $addr = $this->order->bilingAddress;

//      $x= (new MailMessage)
//            ->subject("New Order #{$this->order->number}")
//            ->from('notification@ajyal-store.ps', 'AJYAL Store')
//            ->greeting("Hi {$notifiable->name},")
//            ->line("A new order (#{$this->order->number})")
//            ->action('View Order', url('/dashboard'))
//            ->line('Thank you for using our application!');
//      return $x;
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
