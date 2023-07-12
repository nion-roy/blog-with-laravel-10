<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthorPostApprove extends Notification implements ShouldQueue
{
	use Queueable;

	public $approved;

	/**
	 * Create a new notification instance.
	 */
	public function __construct($approved)
	{
		$this->approved = $approved;
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
			->greeting('Hello, ' . $this->approved->user->name . ' !')
			->subject('Your Post Successfully Approved')
			->line('Your post has been successfully approved.')
			->line('Post title : ' . $this->approved->title)
			->action('View', url(route('post.show', $this->approved->id)))
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
			//
		];
	}
}
