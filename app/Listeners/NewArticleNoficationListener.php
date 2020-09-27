<?php

namespace App\Listeners;

use App\Mail\NewArticleMail;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewArticleNoficationListener
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $subs = Subscription::all();
        foreach($subs as $item) {
            Mail::to($item->email)->send(new NewArticleMail());
        }

    }
}
