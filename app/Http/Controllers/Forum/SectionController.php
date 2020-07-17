<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\forum\Section;
use App\forum\Topic;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sections = Section::all()->SortByDesc('id');

        return view('forum.sections', [
            'sections' => $sections,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('forum.sectionNew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:255',
            'description' => 'required|min:4|max:500',
        ]);

        $section = new Section;
        $section->user_id = Auth::user()->id;
        $section->name = $request->input("name");
        $section->description = $request->input("description");
        $section->save();

        return redirect()->route('forum.section', ['section' => $section->id])->with('success_main', 'Раздел добавлен');


    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function show(Section $section)
    {
        $topics = $section->topics->SortByDesc('id');

        return view('forum.index', [
            'topics' => $topics,
            'section' => $section,
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Section $section
     * @return Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('forum')->with('success_main', 'Раздел удален');

    }
}
