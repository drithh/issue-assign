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

        static::created(function ($issue) {
            $issue->editHistory()->create([
                'field_name' => 'issue_created',
                'old_value' => null,
                'new_value' => null,
                'edited_by' => auth()->id(), // or any user ID
            ]);
        });

        static::updating(function ($issue) {
            foreach ($issue->getDirty() as $field => $newValue) {
                $oldValue = $issue->getOriginal($field);

                if ($oldValue != $newValue) {
                    $issue->editHistory()->create([
                        'field_name' => $field,
                        'old_value' => $oldValue,
                        'new_value' => $newValue,
                        'edited_by' => auth()->id(), // or any user ID
                    ]);
                }
            }
        });

        static::deleting(function ($issue) {
            $issue->editHistory()->create([
                'field_name' => 'issue_deleted',
                'old_value' => null,
                'new_value' => null,
                'edited_by' => auth()->id(), // or any user ID
            ]);
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
