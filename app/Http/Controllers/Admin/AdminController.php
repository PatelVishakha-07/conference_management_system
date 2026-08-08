<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Submission;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'current' => Conference::status('current')->count(),
            'upcoming' => Conference::status('upcoming')->count(),
            'past' => Conference::status('past')->count(),
            'submissions' => Submission::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function submissions(Request $request)
    {
        $query = Submission::with('conference');

        if ($search = $request->get('search')) {
            $query->where('author_name', 'like', "%$search%")
                  ->orWhere('abstract_id', 'like', "%$search%");
        }

        $submissions = $query->latest()->get();
        return view('admin.submissions', compact('submissions'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $submission->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }
}
