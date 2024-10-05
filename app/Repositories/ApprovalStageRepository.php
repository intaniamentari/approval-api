<?php

namespace App\Repositories;

use App\Models\ApprovalStage;
use App\Models\User;
use App\Repositories\Contracts\ApprovalStageRepositoryInterface;

class ApprovalStageRepository implements ApprovalStageRepositoryInterface
{
    public function createApprovalStage(array $data)
    {
        return ApprovalStage::create($data);
    }

    public function updateApprovalStage($id, array $data)
    {
        $approvalStage = ApprovalStage::where('id', $id);
        $approvalStage->update($data);

        return $approvalStage->first();
    }
}
