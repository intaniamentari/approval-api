<?php

namespace App\Repositories\Contracts;

interface ExpenseRepositoryInterface
{
    public function getExpense($id);
    public function createExpense(array $data);
}
