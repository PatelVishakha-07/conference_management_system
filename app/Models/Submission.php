<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'conference_id', 'abstract_id', 'author_name', 'email', 'phone',
        'paper_title', 'presentation_type', 'paper_file', 'status', 'payment_status'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
