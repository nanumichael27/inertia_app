<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicController extends Controller
{
    //

    public function index()
    {
        return Inertia::render('Topics/Index', [
            'topics' => Topic::all()->map(function($topic){
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'image' => asset('/storage/'.$topic->image)
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Topics/Create');
    }

    public function store()
    {
        $image = Request::file('image')->store('topics', 'public');
        Topic::create([
            'name' => Request::input('name'),
            'image' => $image,
        ]);

        return Redirect::route('topics.index');
    }
}

