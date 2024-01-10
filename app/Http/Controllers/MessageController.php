<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->get();
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required']);

        Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back();
    }

    public function destroy(Message $message)
    {

        $message->delete();

        return back()->with("success", "Message supprimé avec succès.");
    }
}
