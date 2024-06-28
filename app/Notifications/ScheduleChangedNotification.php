<?php 

namespace App\Notifications;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScheduleChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $oldSchedule;
    protected $newSchedule;
    protected $oldShiftName;
    protected $newShiftName;
    protected $sender;
    protected $role;
    protected $oldUserEmail;
    protected $newUserEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $sender, array $oldSchedule, array $newSchedule, $oldUserId, $newUserId)
    {
        $this->oldSchedule = $oldSchedule;
        $this->newSchedule = $newSchedule;
        $this->sender = $sender;

        // Ambil role dari sender
        $senderData = User::find($this->sender['id']);
        if ($senderData) {
            $this->role = $senderData->role;
            $this->sender = $senderData->full_name;
        } else {
            $this->role = 'Pengguna tidak ditemukan';
            $this->sender = 'Pengguna tidak ditemukan';
        }

        $oldUser = User::find($oldUserId);
        $newUser = User::find($newUserId);

        $this->oldUserEmail = $oldUser ? $oldUser->email : null;
        $this->newUserEmail = $newUser ? $newUser->email : null;

        // Ambil informasi shift
        $this->oldShiftName = Shift::find($this->oldSchedule['shift_id'])->shift_name ?? 'Shift lama tidak ditemukan';
        $this->newShiftName = Shift::find($this->newSchedule['shift_id'])->shift_name ?? 'Shift baru tidak ditemukan';
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
            ->subject('Perubahan Jadwal Shift Kerja Operator')
            ->line('Jadwal Shift Kerja Anda TELAH DIGANTI dengan Operator Lain oleh ' . $this->sender . ' (' . $this->role . '). Berikut adalah detail jadwal yang diganti:')
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
