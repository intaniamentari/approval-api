<?php

namespace App\Repositories\Contracts;

interface ApprovalStageRepositoryInterface
{
    public function createApprovalStage(array $data);
    public function updateApprovalStage($id, array $data);
}
