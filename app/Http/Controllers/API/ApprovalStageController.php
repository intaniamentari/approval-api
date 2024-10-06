<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApprovalStageResource;
use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Repositories\Contracts\ApprovalStageRepositoryInterface;
use Illuminate\Validation\ValidationException;

class ApprovalStageController extends Controller
{

    protected $approvalStageRepository;

    public function __construct(ApprovalStageRepositoryInterface $approvalStageRepository)
    {
        $this->approvalStageRepository = $approvalStageRepository;
    }

    /**
        *    @OA\Post(
        *       path="/approval-stages",
        *       tags={"Approval Stage"},
        *       summary="Create approval stage",
        *       description="Create new approver user",
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
        *           description="Successful create approval stage"
        *      ),
        *  )
        */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'approver_id' => 'required|numeric|unique:approval_stages,approver_id'
            ]);

            $approvalStage = $this->approvalStageRepository->createApprovalStage($data);

            return response()->json([
                'status' => 201,
                'message' => 'Approval stage created successfully.',
                'data' => new ApprovalStageResource($approvalStage)
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
        *    @OA\Put(
        *       path="/approval-stages/{id}",
        *       tags={"Approval Stage"},
        *       summary="Update approval stage",
        *       description="Update approval stage",
        *       @OA\Parameter(
        *         name="id",
        *         in="path",
        *         description="ID Approval Stage",
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
        *           description="Successful update approval stage"
        *      ),
        *  )
        */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'approver_id' => 'required|numeric|unique:approval_stages,approver_id'
            ]);

            $approvalStage = $this->approvalStageRepository->updateApprovalStage($id, $data);

            return response()->json([
                'status' => 200,
                'message' => 'Approval stage updated successfully.',
                'data' => new ApprovalStageResource($approvalStage)
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
