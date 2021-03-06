<?php

namespace App\Notifications\User;

use App\Channels\Aakash;
use App\model\OrderItem;
use App\model\ShippingDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderComfirmation extends Notification implements ShouldQueue
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
        //'mail',Aakash::class
        if(env('invoice',0)==1){

            return ['mail',Aakash::class,OneSignalChannel::class];
        }else{
            return ['mail',OneSignalChannel::class];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        $shipping=$notifiable;
        $orders=OrderItem::whereIn('id',$this->ids)->get();

        return (new MailMessage)->subject('Order Comfirmed')->view(
            'email.order.receipt',
            ['shipping' => $shipping,'orders'=>$orders]
        );
    }

    public function toOneSignal($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        $tt='';
        if($shipping->vendor_id==null|| $shipping->vendor_id==0){
            $tt="Your Pickup OTP is ".$shipping->otp.".";
        }
        // dd($shipping);
        $data= OneSignalMessage::create()
            ->setSubject("A New Order Added")
            ->setBody("Your Orders ".$text."\n Has Been Approved".$tt."\nCheck Your Account\n.")
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
            return $data;
    }

    public function toAakash($notifiable){
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $tt='';
        $tt="Your Pickup OTP is ".$notifiable->otp.".";
        if($notifiable->vendor_id!=null && $notifiable->vendor_id!=0){
            $tt.="Check Your Account";
        }
        return ['to'=>$notifiable->phone,"text"=>"Your Orders ".$text."\n Has Been Approved.".$tt."\n-".env('APP_NAME','laravel')];
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
