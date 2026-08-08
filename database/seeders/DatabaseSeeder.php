<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conference;
use App\Models\ConferenceMaterial;
use App\Models\Department;
use App\Models\Submission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         // 1. Departments
         $departments = collect(['CSE', 'ECE', 'Mechanical', 'Civil'])->mapWithKeys(function ($d) {
            $dept = Department::create(['name' => $d, 'code' => $d]);
            return [$d => $dept];
        });

        // 2. Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@lju.ac.in',
            'password' => bcrypt('admin123'),
        ]);

        // 3. Conferences — one past, one current, one upcoming, per department is overkill,
        //    so we'll spread a handful across departments to keep the demo realistic.

        $conferencesData = [
            [
                'department' => 'CSE',
                'title' => 'International Conference on AI & Machine Learning 2025',
                'description' => 'A completed conference covering advances in AI, ML, and deep learning research.',
                'start_date' => now()->subMonths(4),
                'end_date' => now()->subMonths(4)->addDays(2),
                'registration_deadline' => now()->subMonths(5),
            ],
            [
                'department' => 'ECE',
                'title' => 'CodeApex Technical Symposium 2026',
                'description' => 'The current flagship technical event happening today, live across all tracks.',
                'start_date' => now(),
                'end_date' => now()->addDays(1),
                'registration_deadline' => now()->subDays(5),
            ],
            [
                'department' => 'Mechanical',
                'title' => 'National Conference on Robotics & Automation',
                'description' => 'Upcoming conference open for registration, focused on robotics and industrial automation.',
                'start_date' => now()->addMonths(2),
                'end_date' => now()->addMonths(2)->addDays(2),
                'registration_deadline' => now()->addMonths(1)->addDays(20),
            ],
            [
                'department' => 'Civil',
                'title' => 'Sustainable Infrastructure & Smart Cities Summit',
                'description' => 'Upcoming summit on sustainable construction and smart city planning.',
                'start_date' => now()->addMonths(3),
                'end_date' => now()->addMonths(3)->addDays(1),
                'registration_deadline' => now()->addMonths(2)->addDays(15),
            ],
            [
                'department' => 'CSE',
                'title' => 'IEEE Cybersecurity & Cloud Computing Conference',
                'description' => 'A past conference archived with reports and session materials.',
                'start_date' => now()->subMonths(8),
                'end_date' => now()->subMonths(8)->addDays(3),
                'registration_deadline' => now()->subMonths(9),
            ],
        ];

        $conferences = collect();
        foreach ($conferencesData as $c) {
            $conference = Conference::create([
                'department_id' => $departments[$c['department']]->id,
                'title' => $c['title'],
                'description' => $c['description'],
                'start_date' => $c['start_date'],
                'end_date' => $c['end_date'],
                'registration_deadline' => $c['registration_deadline'],
                'call_for_papers' => 'Submit original, unpublished research papers relevant to the conference theme. Selected papers will be published in the proceedings.',
                'featured' => true,
            ]);

            $conferences->push($conference);

            // 4. Materials for each conference (placeholder file paths — no real files needed for demo)
            ConferenceMaterial::create([
                'conference_id' => $conference->id,
                'type' => 'brochure',
                'file_path' => 'materials/sample-brochure.pdf',
            ]);
            ConferenceMaterial::create([
                'conference_id' => $conference->id,
                'type' => 'flyer',
                'file_path' => 'materials/sample-flyer.pdf',
            ]);
        }

        // 5. Sample submissions (attached to the "current" and "upcoming" conferences)
        $submissionTargets = $conferences->filter(fn($c) => $c->status !== 'past')->values();

        $sampleAuthors = [
            ['name' => 'Aarav Patel', 'email' => 'aarav.patel@example.com', 'title' => 'Deep Learning for Predictive Maintenance', 'type' => 'paper'],
            ['name' => 'Diya Shah', 'email' => 'diya.shah@example.com', 'title' => 'IoT-Based Smart Irrigation System', 'type' => 'poster'],
            ['name' => 'Kabir Mehta', 'email' => 'kabir.mehta@example.com', 'title' => 'Blockchain for Secure Academic Records', 'type' => 'paper'],
        ];

        foreach ($sampleAuthors as $i => $author) {
            $conf = $submissionTargets[$i % max($submissionTargets->count(), 1)] ?? $conferences->first();

            Submission::create([
                'conference_id' => $conf->id,
                'abstract_id' => 'ABS' . now()->format('y') . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'author_name' => $author['name'],
                'email' => $author['email'],
                'phone' => '98765432' . $i,
                'paper_title' => $author['title'],
                'presentation_type' => $author['type'],
                'status' => ['submitted', 'under_review', 'accepted'][$i % 3],
                'payment_status' => $i % 2 === 0 ? 'paid' : 'pending',
            ]);
        }
    }
}
