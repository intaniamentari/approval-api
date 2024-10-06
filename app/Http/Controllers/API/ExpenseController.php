<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExpenseController extends Controller
{
    protected $expenseStageRepository;

    public function __construct(ExpenseRepositoryInterface $expenseStageRepository)
    {
        $this->expenseStageRepository = $expenseStageRepository;
    }

    /**
        *    @OA\Post(
        *       path="/expense",
        *       tags={"Expense"},
        *       summary="Create expense",
        *       description="Create expense",
        *       @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(
        *             @OA\Property(
        *                 property="amount",
        *                 type="integer",
        *                 description="amount expense (minimum value = 1)"
        *             )
        *         )
        *     ),
        *       @OA\Response(
        *           response="200",
        *           description="Successful create expense"
        *      ),
        *  )
        */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'amount' => 'required|numeric|min:1'
            ]);

            $expense = $this->expenseStageRepository->createExpense($data);

            return response()->json([
                'status' => 201,
                'message' => 'Success create new Expense',
                'data' => new ExpenseResource($expense)
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
        *    @OA\Get(
        *       path="/expense/{id}",
        *       tags={"Expense"},
        *       summary="Detail Expense",
        *       description="Detail Expense",
        *       @OA\Parameter(
        *         name="id",
        *         in="path",
        *         description="ID expense",
        *         required=true,
        *         @OA\Schema(type="integer")
        *       ),
        *       @OA\Response(
        *           response="200",
        *           description="Successful get data expense"
        *      ),
        *  )
        */
    public function show($id){
        $getExpense = $this->expenseStageRepository->getExpense($id);

        return response()->json([
            'status' => 200,
            'message' => 'Success get data Expense',
            'data' => new ExpenseResource($getExpense)
        ], 200);
    }
}
