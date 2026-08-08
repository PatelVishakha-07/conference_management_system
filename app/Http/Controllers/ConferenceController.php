<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Department;

class ConferenceController extends Controller
{
    public function home()
    {
        $currentConferences = Conference::status('current')->with('department')->get();
        return view('home', compact('currentConferences'));
    }

    public function index()
    {
        $conferences = Conference::with('department')
            ->get()
            ->filter(fn($c) => in_array($c->status, ['current', 'upcoming']))
            ->sortBy('start_date');

        return view('conferences.index', compact('conferences'));
    }

    public function archive()
    {
        $conferences = Conference::status('past')->with('department')->orderByDesc('start_date')->get();
        return view('conferences.archive', compact('conferences'));
    }

    public function show(Conference $conference)
    {
        $conference->load('department', 'materials');
        return view('conferences.show', compact('conference'));
    }

    public function byDepartment($code)
    {
        $department = Department::where('code', $code)->firstOrFail();
        $conferences = $department->conferences()->get();
        return view('conferences.department', compact('department', 'conferences'));
    }
}
