<?php

namespace App\Repositories\Contracts;

interface ApprovalRepositoryInterface
{
    public function updateApprovalStatus($id, $data);
}
