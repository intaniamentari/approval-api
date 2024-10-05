<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ApprovalRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApprovalController extends Controller
{
    protected $approvalRepository;

    public function __construct(ApprovalRepositoryInterface $approvalRepository)
    {
        $this->approvalRepository = $approvalRepository;
    }
    /**
        *    @OA\Patch(
        *       path="/expense/{id}/approve",
        *       tags={"Expense"},
        *       summary="Update expense",
        *       description="Update expense",
        *       @OA\Parameter(
        *         name="id",
        *         in="path",
        *         description="ID expense",
        *         required=true,
        *         @OA\Schema(type="string")
        *       ),
        *       @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(
        *             @OA\Property(
        *                 property="approver_id",
        *                 type="integer",
        *                 description="Approver ID"
        *             )
        *         )
        *     ),
        *       @OA\Response(
        *           response="200",
        *           description="Successful update expense stage"
        *      ),
        *  )
        */

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'approver_id' => 'required|numeric'
            ]);

            info(`🌹 approver id = {$request->approver_id}`);

            $approvalStage = $this->approvalRepository->updateApprovalStatus($id, $request->approver_id);

            if($approvalStage == 'success'){
                return response()->json([
                    'message' => 'Success update Approval Stage',
                    'data' => $approvalStage
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Approver does not have permission to change status',
                ], 422);
            }

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}