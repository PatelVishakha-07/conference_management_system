<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Submission;
use App\Models\ConferenceMaterial;
use App\Models\Department;

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

    public function index()
    {
        $conferences = Conference::with('department')->latest()->get();
        return view('admin.conferences.index', compact('conferences'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.conferences.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_deadline' => 'nullable|date',
            'call_for_papers' => 'nullable|string',
            'brochure' => 'nullable|file|mimes:pdf|max:10240',
            'flyer' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        $conference = Conference::create([
            ...collect($data)->except(['brochure', 'flyer'])->toArray(),
            'featured' => $request->boolean('featured'),
        ]);

        $this->storeMaterials($request, $conference);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully.');
    }

    public function edit(Conference $conference)
    {
        $departments = Department::all();
        $conference->load('materials');
        return view('admin.conferences.edit', compact('conference', 'departments'));
    }


    public function update(Request $request, Conference $conference)
    {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_deadline' => 'nullable|date',
            'call_for_papers' => 'nullable|string',
            'brochure' => 'nullable|file|mimes:pdf|max:10240',
            'flyer' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $conference->update([
            ...collect($data)->except(['brochure', 'flyer'])->toArray(),
            'featured' => $request->boolean('featured'),
        ]);
        $this->storeMaterials($request, $conference);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully.');
    }

    public function destroy(Conference $conference)
    {
        $conference->delete();
        return back()->with('success', 'Conference deleted.');
    }

    private function storeMaterials(Request $request, Conference $conference): void
    {
        foreach (['brochure', 'flyer'] as $type) {
            if ($request->hasFile($type)) {
                // replace existing material of this type, if any
                $conference->materials()->where('type', $type)->delete();

                $path = $request->file($type)->store('materials', 'public');
                ConferenceMaterial::create([
                    'conference_id' => $conference->id,
                    'type' => $type,
                    'file_path' => $path,
                ]);
            }
        }
    }

    
}
