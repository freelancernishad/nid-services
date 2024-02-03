<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;
    public $token;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
        // $userId = $id;
        // $this->user =User::find($userId);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        ->subject('পাসওয়ার্ড রিসেট')
        ->greeting("ওহে, $notifiable->name",url('/'))
        ->from('info@uniontax.gov.bd','Tepriganj High BL School')
        ->line('আপনি এই ইমেলটি পাচ্ছেন কারণ আমরা আপনার অ্যাকাউন্টের জন্য একটি পাসওয়ার্ড পুনরায় সেট করার অনুরোধ পেয়েছি৷.') // Here are the lines you can safely override
        ->action('পাসওয়ার্ড রিসেট', url('password/reset', $this->token))
        ->success()
        ->line('আপনি যদি পাসওয়ার্ড রিসেট করার অনুরোধ না করে থাকেন, তাহলে আর কোনো পদক্ষেপের প্রয়োজন নেই।');
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
