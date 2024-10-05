<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approval extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_id',
        'approval_stage_id',
        'status_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function approvalStage()
    {
        return $this->belongsTo(ApprovalStage::class);
    }

    public function approver()
    {
        return $this->approvalStage->approver;
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
