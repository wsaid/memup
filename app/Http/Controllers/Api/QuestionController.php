<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        $data = Subject::with('topics')->get();
        $query = Question::with('choices');

        if ($topic->exists) {
            $query->where('topic_id', $topic->id);
        }
        
        return Inertia::render('Frontend/Questions/Index', [
            'questions' => new QuestionResource($query->inRandomOrder()->first()),
            'menuItems' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getByTopic(Topic $topic)
    {
        return Question::where('topic_id', $topic->id)->take(5)->get();
    }

    public function checkAnswer(Question $question, Choice $choice) {

        if ($question->answer->id == $choice->id) {
            return Redirect::back()->with('success', 'Well done, Correct answer');
        }

        return Redirect::back()->with('error', 'Wrong answer');

        // return Redirect::back()->with('success', 'correct');

        // return Inertia::render('Questions/Index', ['success' => true]);
        // return $question->answer->id == $choice->id;
    }
}
