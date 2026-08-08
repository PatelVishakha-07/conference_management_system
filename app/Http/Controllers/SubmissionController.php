<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function create()
    {
        $conferences = Conference::with('department')
            ->get()
            ->filter(fn($c) => in_array($c->status, ['current', 'upcoming']));

        return view('submissions.create', compact('conferences'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'conference_id' => 'required|exists:conferences,id',
            'author_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'paper_title' => 'required|string|max:255',
            'presentation_type' => 'required|in:paper,poster',
            'paper_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        if ($request->hasFile('paper_file')) {
            $data['paper_file'] = $request->file('paper_file')->store('papers', 'public');
        }

        $data['abstract_id'] = 'ABS' . now()->format('y') . str_pad(Submission::count() + 1, 4, '0', STR_PAD_LEFT);

        $submission = Submission::create($data);

        return redirect()->route('submissions.success', $submission)
            ->with('success', 'Submission received! Your Abstract ID is ' . $submission->abstract_id);
    }

    public function success(Submission $submission)
    {
        return view('submissions.success', compact('submission'));
    }

    public function pay(Submission $submission)
    {
        $submission->update(['payment_status' => 'paid']);
        return back()->with('success', 'Payment marked as completed.');
    }
    
}
