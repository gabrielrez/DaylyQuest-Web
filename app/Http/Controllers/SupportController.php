<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function sendMessage()
    {
        $message = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        SupportMessage::create($message);

        // Send email here ✉️

        return redirect()->back();
    }
}
