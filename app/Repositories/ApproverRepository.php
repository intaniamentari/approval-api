<?php

namespace App\Repositories;

use App\Models\Approver;
use App\Repositories\Contracts\ApproverRepositoryInterface;

class ApproverRepository implements ApproverRepositoryInterface
{
    public function createApprover(array $data)
    {
        $approver = Approver::create($data);
        return $approver;
    }
}
