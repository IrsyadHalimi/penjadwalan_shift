<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;

class ScheduleUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $oldSchedule;
    protected $newSchedule;
    protected $oldShiftName;
    protected $newShiftName;
    protected $sender;
    protected $operator;
    protected $operatorName;
    protected $role;
    protected $company;
    protected $department;
    protected $operatorType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $sender, array $operator, array $oldSchedule, array $newSchedule)
    {
        $this->oldSchedule = $oldSchedule;
        $this->newSchedule = $newSchedule;
        $this->sender = $sender;
        $this->operator = $operator;

        // Ambil role dari sender
        $senderData = User::find($this->sender['id']);
        if ($senderData) {
            $this->role = $senderData->role;
            $this->sender = $senderData->full_name;
        } else {
            $this->role = 'Pengguna tidak ditemukan';
            $this->sender = 'Pengguna tidak ditemukan';
        }

        $operatorData = User::find($this->operator['id']);
        if ($operatorData) {
            $this->operatorName = $operatorData->full_name;
            $this->company = $operatorData->company->company_name;
            $this->department = $operatorData->department->department_name;
            $this->operatorType = $operatorData->operatorType->operator_name_type;
        } else {
            $this->operatorName = 'Pengguna tidak ditemukan';
            $this->company = 'Pengguna tidak ditemukan';
            $this->department = 'Pengguna tidak ditemukan';
            $this->operatorType = 'Pengguna tidak ditemukan';
        }

        $this->oldShiftName = Shift::find($this->oldSchedule['shift_id'])->shift_name;
        $this->newShiftName = Shift::find($this->newSchedule['shift_id'])->shift_name;
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
                    ->line('Perusahaan ' . $this->company)
                    ->line('Departemen ' . $this->department)
                    ->line('Jenis Operator ' . $this->operatorType)
                    ->line('Jadwal Shift Kerja Anda Telah Diperbarui oleh '. $this->sender .' ('.$this->role.'). Berikut adalah detail perubahan:')
                    ->line('Shift (Lama): ' . $this->oldShiftName)
                    ->line('Shift (Baru): ' . $this->newShiftName)
                    ->line('Tanggal Mulai (Lama): ' . $this->oldSchedule['start_date'])
                    ->line('Tanggal Mulai (Baru): ' . $this->newSchedule['start_date'])
                    ->line('Tanggal Selesai (Lama): ' . $this->oldSchedule['end_date'])
                    ->line('Tanggal Selesai (Baru): ' . $this->newSchedule['end_date'])
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
            'sender' => $this->sender,
        ];
    }
}
