<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'findings',
        'criteria',
        'requirements',
        'root_cause_analysis',
        'corrective_actions',
        'target_time',
        'is_accepted',
    ];

    protected $casts = [
        'target_time' => 'datetime',
        'is_accepted' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function issueResolution()
    {
        return $this->hasOne(IssueResolution::class);
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

    public function scopeForDepartment(Builder $query, Department $department)
    {
        return $query->where('department_id', $department->id);
    }
}
