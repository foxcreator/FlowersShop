<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Notifications\TelegramFeedbackNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        if ($request->name && $request->phone && $request->question) {
            $feedback = Feedback::create($request->all());

            if ($feedback) {
                Notification::route('telegram', -4219102586)
                    ->notify(new TelegramFeedbackNotification($feedback));
                return redirect()->back()->with(['success' => 'Спасибо за обращение! Мы скоро с вами свяжемся!']);
            }
        } else {
            return redirect()->back()->with(['error' => 'All field must be write']);
        }
    }
}
