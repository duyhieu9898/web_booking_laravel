<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $messages = auth()
            ->user()
            ->messages()
            ->where(function ($query) {
                $query->bySender(request()->input('sender_id'))
                    ->byReceiver(auth()->user()->id);
            })
            ->orWhere(function ($query) {
                $query->bySender(auth()->user()->id)
                    ->byReceiver(request()->input('sender_id'));
            })
            ->latest()
            ->take(10)
            ->get();
        return array_reverse($messages->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id'   => $request->input('sender_id'),
            'receiver_id' => $request->input('receiver_id'),
            'message'     => $request->input('message'),
        ]);

        broadcast(new MessageSent($message));

        return $message->fresh();
    }
}
