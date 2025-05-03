<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRecipeNotification extends Notification
{
    use Queueable;

    protected $recipe;

    /**
     * Create a new notification instance.
     */
    public function __construct($recipe)
    {
        $this->recipe = $recipe;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Une nouvelle recette a été ajoutée !')
            ->action('Voir la recette', url('/recipes/'.$this->recipe->id));
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Nouvelle recette : '.$this->recipe->title,
            'link' => '/recipes/'.$this->recipe->id
        ];
    }
}
