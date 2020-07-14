<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\forum\Topic;
use App\forum\Section;
use App\forum\Message;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;


class MessageController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, $section, $topic)
    {
        $validatedData = $request->validate([
            'message' => 'required|min:4|max:5000',
        ]);

        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->topic_id = $topic;
        $message->content = $request->input('message');
        $message->save();
        return redirect()->route('forum.topic', ['section' => $section, 'topic' => $topic])->with('success_main', 'Сообщение отправлено');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Message $message
     * @return Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Message $message
     * @return Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return Response
     */
    public function destroy(Section $section, Topic $topic, Message $message)
    {

        $message = Message::find($message->id);
        $message->delete();
        return redirect()->route('forum.topic', ['topic' => $topic->id, 'section' => $section->id])->with('success_main', 'Сообщение удалено');


    }
}
