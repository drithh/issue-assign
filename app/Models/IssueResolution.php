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
            $resolution->resolved_at = now();
        });

        static::updating(function ($resolution) {
            $resolution->resolved_by = Auth::id();
            $resolution->resolved_at = now();
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
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
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

    public function getIsAcceptedAttribute($value)
    {
        return (bool) $value;
    }

    public function setIsAcceptedAttribute($value)
    {
        $this->attributes['is_accepted'] = (bool) $value;
    }

    public function scopeAccepted(Builder $query)
    {
        return $query->where('is_accepted', true);
    }

    public function scopePending(Builder $query)
    {
        return $query->where('is_accepted', false);
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
