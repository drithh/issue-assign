<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Issue extends Model
{
    protected static function booted(): void
    {
        static::addGlobalScope('department', function (Builder $query) {
            if (auth()->check() && !auth()->user()->is_admin) {
                $query->where('department_id', auth()->user()->department_id);
            }
        });
    }

    use HasFactory;

    protected $fillable = [
        'department_id',
        'findings',
        'criteria',
        'requirements',
        'root_cause_analysis',
        'corrective_actions',

        'target_time',
        'resolution_description',
        'file_url',
        'submitted_by',
        'submitted_at',

        'status',
        'comment',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($issue) {
            if (!Auth::user()->is_admin) {
                $issue->status = 'submitted';
                $issue->submitted_by = Auth::id();
                $issue->submitted_at = now();
            }
        });
    }

    protected $casts = [
        'target_time' => 'datetime',
        'status' => 'string',
        'file_url' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // public function issueResolution()
    // {
    //     return $this->hasOne(IssueResolution::class);
    // }

    public function getTargetTimeAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-m-d\TH:i');
    }

    public function setTargetTimeAttribute($value)
    {
        $this->attributes['target_time'] = $this->asDateTime($value);
    }


    public function scopeForDepartment(Builder $query, Department $department)
    {
        return $query->where('department_id', $department->id);
    }
}
