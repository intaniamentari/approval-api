<?php

namespace App\Repositories;

use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use App\Models\User;
use App\Repositories\Contracts\ApprovalRepositoryInterface;

class ApprovalRepository implements ApprovalRepositoryInterface
{
    public function updateApprovalStatus($id, $approver_id)
    {
        // get newest tracking approval expense
        $approval = Approval::where('expense_id', $id)->orderBy('id', 'desc')->first();

        // total stage
        $approvalStageCount = ApprovalStage::count();

        if($approval->status_id == 1 && $approval->approvalStage->approver_id == $approver_id){
            if($approval->approval_stage_id != $approvalStageCount){
                Approval::where('expense_id', $id)->update([
                    'status_id' => 2
                ]);

                Approval::create([
                    'expense_id' => $id,
                    'approval_stage_id' => $approval->approval_stage_id + 1,
                    'status_id' => 1
                ]);
            } else {
                // all stage approval are complete
                Approval::where('expense_id', $id)->update([
                    'status_id' => 2
                ]);

                Expense::find($id)->update(['status_id' => 2]);
            }

            return 'success';
        } else {
            return 'failed';
        }

        // $previousExpense = Expense::where('id', '<', $id)
        //     ->orderBy('id', 'desc')
        //     ->first();

        // if ($previousExpense && $previousExpense->status_id == 1) {
        //     return response()->json([
        //         'message' => 'Cannot update. Previous expense status is still 1.'
        //     ], 400);
        // }

        // $updated = Expense::where('id', $id)->update($data);

        // return $updated;
    }
}
