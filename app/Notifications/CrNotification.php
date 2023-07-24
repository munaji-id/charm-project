<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CrNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $cr;

    public function __construct($cr, $user, $proyek, $status)
    {
        $this->cr = $cr;
        $this->user = $user;
        // $this->user_current = $user_current;
        $this->proyek = $proyek;
        $this->status = $status;
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
        if ($this->cr->status_id == 'S1') {
            return (new MailMessage)
                ->subject("{$this->cr['id']} : {$this->cr['judul']}")
                ->greeting("Hi,  {$this->user['nama_lengkap']}")
                ->line('Permintaan Perubahan di tugaskan kepada Anda,')
                ->line('Dengan detail sebagai berikut,')
                ->line("Nomor CR : {$this->cr['id']}")
                ->line("Judul : {$this->cr['judul']}")
                ->line("Proyek : {$this->proyek['nama_proyek']}")
                ->line("Status : {$this->status['nama_status']}")
                ->line("Batas Waktu : {$this->cr['batas_waktu']}")
                // ->line("Password : {$this->request['retype_password']}")
                ->line('Untuk masuk ke Aplikasi Change Request Management')
                ->action('Login Disini', url('/cr'))
                ->line('Thank you for using our application!');
        } elseif ($this->cr->status_id == 'S3') {
            return (new MailMessage)
                ->subject("{$this->cr['id']} : {$this->cr['judul']}")
                ->greeting("Hi,  {$this->user['nama_lengkap']}")
                ->line('Permintaan Perubahan di tugaskan kepada Anda,')
                ->line('Dengan detail sebagai berikut,')
                ->line("Nomor CR : {$this->cr['id']}")
                ->line("Judul : {$this->cr['judul']}")
                ->line("Proyek : {$this->proyek['nama_proyek']}")
                ->line("Status : {$this->status['nama_status']}")
                ->line("Batas Waktu : {$this->cr['batas_waktu']}")
                // ->line("Password : {$this->request['retype_password']}")
                ->line('Untuk masuk ke Aplikasi Change Request Management')
                ->action('Login Disini', url('/cr'))
                ->line('Thank you for using our application!');
        }
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
