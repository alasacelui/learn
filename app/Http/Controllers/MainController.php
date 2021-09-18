<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $courses =  \App\Http\Resources\CourseResource::collection(\App\Models\Course::all());
        return view('main', compact('courses'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required', 'message' => 'required' , 'email' => 'required|email|unique:messages,email']);

        \App\Models\Message::create($data);

        return back()->with('message', 'Message sent successfully. We will update you sooner. Keep Safe !');
    }
}
