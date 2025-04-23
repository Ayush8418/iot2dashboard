<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'service' => 'required|max:255',
        'message' => 'required|max:1000',
    ]);

    Mail::to('ayushkumar8418@gmail.com')->send(new ContactFormMail($validatedData));

    return back()->with('success', 'Your message has been sent!');
}
}

