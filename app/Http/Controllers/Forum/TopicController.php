<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\forum\Section;
use App\forum\Topic;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Section $section)
    {
        return view('forum.topicNew', ['section' => $section]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Section $section, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:255',
            'message' => 'required|min:4|max:5000',
        ]);

        $topic = new Topic;
        $topic->user_id = Auth::user()->id;
        $topic->section_id = $section->id;
        $topic->name = $request->input("name");
        $topic->content = $request->input("message");

        $topic->save();
        return redirect()->route('forum.topic', ['section' => $section->id, 'topic' => $topic->id])->with('success_main', 'Тема добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return Response
     */
    public function show(Section $section, Topic $topic)
    {

        return view('forum.topic', ['section' => $section, 'topic' => $topic]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Topic $topic
     * @return Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Topic $topic
     * @return Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     * @return Response
     */
    public function destroy(Section $section, Topic $topic)
    {
        $topic->messages()->delete();
        $topic->delete();
        return redirect()->route('forum.section', ['section' => $section->id])->with('success_main', 'Тема со всеми ее сообщениями была удалена');
    }

}
