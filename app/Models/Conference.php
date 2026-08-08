<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'department_id', 'title', 'description', 'start_date',
        'end_date', 'registration_deadline', 'call_for_papers', 'featured'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_deadline' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function materials()
    {
        return $this->hasMany(ConferenceMaterial::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getStatusAttribute(): string
    {
        $today = now()->startOfDay();
        if ($today->lt($this->start_date)) return 'upcoming';
        if ($today->gt($this->end_date)) return 'past';
        return 'current';
    }

    public function scopeStatus($query, $status)
    {
        $today = now()->startOfDay()->toDateString();
        return match ($status) {
            'current'  => $query->whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today),
            'upcoming' => $query->whereDate('start_date', '>', $today),
            'past'     => $query->whereDate('end_date', '<', $today),
        };
    }
    
}
