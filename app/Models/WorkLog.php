<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'project_id',
        'summary',
        'description',
        'worked_at'
    ];

    public function scopeOfRef(Builder $builder, $ref): Builder
    {
        return $builder->where('ref', $ref);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
