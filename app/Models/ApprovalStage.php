<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalStage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'approval_stages';

    protected $fillable = [
        'approver_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function approver()
    {
        return $this->belongsTo(Approver::class);
    }

    public function approval()
    {
        return $this->hasMany(Approval::class);
    }
}
