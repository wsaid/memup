<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Http\Resources\TopicResource;
use App\Models\Organization;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        return Inertia::render('Questions/Index', [
            'filters' => Request::all('search', 'trashed'),
            'questions' => Question::with('topic', 'topic.subject')->orderBy('id')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                // ->through(fn ($organization) => [
                //     'id' => $organization->id,
                //     'name' => $organization->name,
                //     'phone' => $organization->phone,
                //     'city' => $organization->city,
                //     'deleted_at' => $organization->deleted_at,
                // ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function store()
    {
        Auth::user()->account->organizations()->create(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::route('organizations')->with('success', 'Organization created.');
    }

    public function edit(Question $question)
    {
        // $topics = Topic::where('subject_id', $question->topic->subject_id);
        // dd(new TopicResource($topics));
        $topics = Topic::all()->where('subject_id', $question->topic->subject_id);
        $subjects = Subject::all();
        return Inertia::render('Questions/Edit', [
            'question' => [
                'id' => $question->id,
                'text' => $question->text,
                'deleted_at' => $question->deleted_at,
                'topic' => $question->topic,
                'subject' => $question->topic->subject,
                'choices' => $question->choices()->get()->map->only('id', 'text', 'is_correct'),
            ],
            'topics' => TopicResource::collection($topics),
            'subjects' => SubjectResource::collection($subjects),

        ]);
    }

    public function update(Question $question)
    {
        $question->update(
            Request::validate([
                'question_text' => ['required', 'max:100'],
                // 'email' => ['nullable', 'max:50', 'email'],
                // 'phone' => ['nullable', 'max:50'],
                // 'address' => ['nullable', 'max:150'],
                // 'city' => ['nullable', 'max:50'],
                // 'region' => ['nullable', 'max:50'],
                // 'country' => ['nullable', 'max:2'],
                // 'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'Organization updated.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    public function restore(Question $question)
    {
        $question->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }
}
