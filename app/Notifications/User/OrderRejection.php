<?php

namespace App\Notifications\User;

use App\Channels\Aakash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderRejection extends Notification
{
    use Queueable;

    protected $ids;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($_ids)
    {
        $this->ids=$_ids;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [Aakash::class,OneSignalMessage::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toOneSignal($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        return OneSignalMessage::create()
            ->setSubject("A New Order Added")
            ->setBody("Your Orders ".$text."\n Has Been Rejected.\nCheck Your Account\n.")
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
    }

    public function toAakash($notifiable){
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
     

        return ['to'=>$notifiable->phone,"text"=>"Your Orders ".$text."\n Has Been Rejected.\nCheck Your Account\n-".env('APP_NAME','laravel')];
    }
}
