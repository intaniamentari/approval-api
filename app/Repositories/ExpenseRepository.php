<?php

namespace App\Repositories;

use App\Http\Resources\ApprovalResource;
use App\Http\Resources\ExpenseResource;
use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use App\Models\User;
use App\Repositories\Contracts\ExpenseRepositoryInterface;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function getExpense($id)
    {
        // return Expense::with(['approval.approvalStage.approver'])->find($id);

        // $expense = Expense::with('approval', 'approval.approvalStage', 'approval.approvalStage.approver')->find($id);
        // return new ExpenseResource($expense);

        $expense = Expense::with('approvals.approvalStage.approver')->find($id);

    $data = [
        'id' => $expense->id,
        'amount' => $expense->amount,
        // 'status_id' => $expense->status_id,
        'status' => [
            'id' => $expense->status->id,
            'status' => $expense->status->name
        ],
        'approvals' => []
    ];

    // Proses setiap approval dalam relasi
    foreach ($expense->approvals as $approval) {
        $data['approvals'][] = [
            'id' => $approval->id,
            'approver' => [
                'id' => $approval->approvalStage->approver->id,
                'name' => $approval->approvalStage->approver->name,
            ],
            'status' => [
                'id' => $approval->status->id,
                'name' => $approval->status->name
            ]
        ];
    }

    return $data;
    }

    public function createExpense(array $data)
    {
        $data['status_id'] = 1;
        $expense = Expense::create($data);

        Approval::create([
            'expense_id' => $expense->id,
            'approval_stage_id' => 1,
            'status_id' => 1
        ]);

        return $expense;
    }
}
