<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Schedule;
use App\Models\Shift;

class ScheduleUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $oldSchedule;
    protected $newSchedule;
    protected $oldShiftName;
    protected $newShiftName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Schedule $oldSchedule, Schedule $newSchedule)
    {
        $this->oldSchedule = $oldSchedule;
        $this->newSchedule = $newSchedule;

        $this->oldShiftName = Shift::where('id', $this->oldSchedule->shift_id)->first();
        $this->newShiftName = Shift::where('id', $this->newSchedule->shift_id)->first();
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
                    ->subject('Perubahan Jadwal Shift Kerja')
                    ->line('Jadwal Shift Kerja Anda Telah Diperbarui oleh Supervisor. Berikut adalah detail perubahan:')
                    ->line('Shift (Lama): ' . $this->oldShiftName->shift_name)
                    ->line('Shift (Baru): ' . $this->newShiftName->shift_name)
                    ->line('Tanggal Mulai (Lama): ' . $this->oldSchedule->start_date)
                    ->line('Tanggal Mulai (Baru): ' . $this->newSchedule->start_date)
                    ->line('Tanggal Selesai (Lama): ' . $this->oldSchedule->end_date)
                    ->line('Tanggal Selesai (Baru): ' . $this->newSchedule->end_date)
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
            'old_schedule' => $this->oldSchedule,
            'new_schedule' => $this->newSchedule,
            'old_shift_name' => $this->oldShiftName,
            'new_shift_name' => $this->newShiftName,
        ];
    }
}
