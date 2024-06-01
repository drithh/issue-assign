<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueEditHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'field_name',
        'old_value',
        'new_value',
        'edited_by',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
