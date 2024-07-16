<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueEditHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'comment',
        'status',
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
