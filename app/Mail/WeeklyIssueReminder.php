<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyIssueReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $resolver_name;
    public $issue_finding;
    public $issue_date;
    public $issue_status;
    public $target_time;
    public $issue_comment;
    /**
     * Create a new message instance.
     *
     * @param string $resolver_name
     * @param string $issue_finding
     * @param string $issue_date
     * @param string $issue_status
     * @param string $target_time
     * @param string $issue_comment
     * @return void
     */
    public function __construct($resolver_name, $issue_finding, $issue_date, $issue_status, $target_time, $issue_comment)
    {
        $this->resolver_name = $resolver_name;
        $this->issue_finding = $issue_finding;
        $this->issue_date = $issue_date;
        $this->issue_status = $issue_status;
        $this->target_time = $target_time;
        $this->issue_comment = $issue_comment;
    }

    public function build()
    {
        return $this->subject('Reminder: Issue Resolution Required')
            ->view('mail.weekly-email-issue');
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
