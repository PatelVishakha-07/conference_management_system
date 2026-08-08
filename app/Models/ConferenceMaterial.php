<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceMaterial extends Model
{
    protected $fillable = ['conference_id', 'type', 'file_path'];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
