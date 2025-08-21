<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\UserEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log ;
use Illuminate\Support\Facades\Mail ;

class SendUserEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */ 
    public $user;
    public function __construct(User $user)
    {
            $this->user = $user;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Logic to send email to the user
        // using a mail service or notification system
        Mail::to($this->user->email)->send(new UserEmail($this->user));
        
        // Optionally, you can log the email sending action
        Log::info('Email sent to user: ' . $this->user->email);
    }
}
