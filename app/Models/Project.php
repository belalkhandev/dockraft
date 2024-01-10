<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'name',
        'key',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => ProjectStatus::class
    ];

    public function scopeOfRef(Builder $builder, $ref): Builder
    {
        return $builder->where('ref', $ref);
    }
}
