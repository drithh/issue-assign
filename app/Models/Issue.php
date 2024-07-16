<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class Issue extends Model
{
    protected static function booted(): void
    {
        static::addGlobalScope('department', function (Builder $query) {
            if (auth()->check() && !auth()->user()->is_admin) {
                $query->where('department_id', auth()->user()->department_id);
            }
        });

        static::created(function ($issue) {
            $issue->editHistory()->create([
                'comment' => null,
                'status' => 'pending',
                'edited_by' => auth()->id(),
            ]);
        });

        static::updated(function ($issue) {
            $is_admin = auth()->user()->is_admin;

            // user cant comment so make it null if not admin
            $issue->editHistory()->create([
                'comment' => $is_admin ? $issue->comment : null,
                'status' => $issue->status,
                'edited_by' => auth()->id(),
            ]);

            // if not is admin then inform all admins that the issue has been submitted
            if (!$is_admin) {
                $admins = User::where('is_admin', true)->get();

                $name = auth()->user()->name;
                foreach ($admins as $admin) {
                    Notification::make()
                        ->title("{$issue->findings} ({$issue->department->name}) has been submitted by {$name}")
                        ->sendToDatabase($admin);
                }
            }
        });
    }

    use HasFactory;

    protected $fillable = [
        'department_id',
        'findings',
        'criteria',
        'additonal_data',

        'target_time',

        'root_cause_analysis',
        'corrective_actions',
        'resolution_description',
        'preventive_actions',
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

    public function editHistory()
    {
        return $this->hasMany(IssueEditHistory::class);
    }

    public function getTargetTimeAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-m-d H:i:s');
    }



    public function setTargetTimeAttribute($value)
    {
        $this->attributes['target_time'] = $this->asDateTime($value);
    }


    // public function scopeForDepartment(Builder $query, Department $department)
    // {
    //     return $query->where('department_id', $department->id);
    // }
}
