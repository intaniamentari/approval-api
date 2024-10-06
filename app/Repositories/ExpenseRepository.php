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
        return Expense::find($id);
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
