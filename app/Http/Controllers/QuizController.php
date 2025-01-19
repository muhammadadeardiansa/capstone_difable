<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('home', compact('subjects'));
    }

    public function show($id)
    {
        $subject = Subject::with('questions')->findOrFail($id);

        // Debug untuk memastikan `options` adalah array
        foreach ($subject->questions as $question) {
            if (!is_array($question->options)) {
                throw new \Exception('Options harus berupa array!');
            }
        }

        return view('quiz', compact('subject'));
    }
}
