<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdmin extends Notification
{
    use Queueable;

    protected $category;
    protected $countBook;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($category,$countBook)
    {
        $this->category=$category;
        $this->countBook=$countBook;
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
        return (new MailMessage())
                    ->level('info')
                    ->line('Se ha creado un nuevo libro en la categoría: '.$this->category)
                    ->line('Total de libros en la categoría: '.$this->countBook)
                    ->action('Visitar Sitio', url('/'));

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
