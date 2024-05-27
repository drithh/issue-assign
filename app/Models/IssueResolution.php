<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class IssueResolution extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($resolution) {
            $resolution->resolved_by = Auth::id();
            $resolution->submitted_at = now();
        });

        static::updating(function ($resolution) {
            $resolution->resolved_by = Auth::id();
            $resolution->submitted_at = now();
        });
    }

    protected static function booted(): void
    {
        static::addGlobalScope('department', function (Builder $query) {
            if (auth()->check() && !auth()->user()->is_admin) {
                $query->whereHas('issue', function ($query) {
                    $query->where('department_id', auth()->user()->department_id);
                });
            }
        });
    }

    use HasFactory;

    protected $fillable = [
        'issue_id',
        'resolution_description',
        'file_url',
        'resolved_by',
        'submitted_at',
        'file'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'file_url' => 'array',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function getTargetTimeAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-m-d\TH:i');
    }

    public function setTargetTimeAttribute($value)
    {
        $this->attributes['target_time'] = $this->asDateTime($value);
    }

    public function scopeForIssue(Builder $query, Issue $issue)
    {
        return $query->where('issue_id', $issue->id);
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('resolved_by', $user->id);
    }

    public function scopeForDepartment(Builder $query, Department $department)
    {
        return $query->whereHas('issue', function ($query) use ($department) {
            $query->where('department_id', $department->id);
        });
    }
}
