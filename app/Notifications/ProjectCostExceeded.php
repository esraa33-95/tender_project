<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;



class ProjectCostExceeded extends Notification
{
    use Queueable;

     protected $project;
    protected $totalCost;
    /**
     * Create a new notification instance.
     */
    public function __construct($project, $totalCost)
    {
        $this->project = $project;
        $this->totalCost = $totalCost;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'التكلفة الكلية للمشروع اكبر من الحد الأقصى للميزانية',
            'project_id' => $this->project->id,
            'project_name' => $this->project->name,
            'budget_to' => $this->project->budget_to,
            'total_cost' => $this->totalCost
        ];
    }
}
