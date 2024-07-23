<?php

namespace App\Jobs;

use App\Mail\WeeklyIssueReminder as MailWeeklyIssueReminder;
use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WeeklyIssueReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // log
        $issues = Issue::with('department.members')
            ->where('status', 'pending')->orWhere('status', 'rejected')
            ->get();

        // sent to all department members
        foreach ($issues as $issue) {
            foreach ($issue->department->members as $member) {
                Mail::to($member->email)->send(new MailWeeklyIssueReminder(
                    $member->name,
                    $issue->findings,
                    $issue->created_at,
                    $issue->status,
                    $issue->target_time,
                    $issue->comment
                ));
                Log::info("Weekly email sent to {$member->email}, with issue {$issue->findings}");
            }
        }
    }
}
