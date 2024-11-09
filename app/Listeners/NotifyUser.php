<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\userMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $users = User::where('is_admin', '!==', 1)->get();
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new userMail($event->post));
        }

    }
}
