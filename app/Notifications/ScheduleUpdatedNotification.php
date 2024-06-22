<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScheduleUpdatedNotification extends Notification
{
    use Queueable;

    public $userId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        \Log::info('Attempting to send email notification.');
        
        return (new MailMessage)
                    ->subject('Perubahan Jadwal Shift Kerja')
                    ->line('Jadwal Shift Kerja Anda Telah Diperbarui oleh Supervisor, silakan login untuk melihat perubahan')
                    ->action('Notification Action', url('/'))
                    ->line('Terima Kasih Telah Menggunakan Layanan Kami!');
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
