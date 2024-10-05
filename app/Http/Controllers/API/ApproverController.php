<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ApproverRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApproverController extends Controller
{
    protected $approverRepository;

    public function __construct(ApproverRepositoryInterface $approverRepository)
    {
        $this->approverRepository = $approverRepository;
    }

    /**
        *    @OA\Post(
        *       path="/approvers",
        *       tags={"Approver"},
        *       summary="Create Approver",
        *       description="Create new approver user",
        *       @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(
        *             @OA\Property(
        *                 property="name",
        *                 type="string",
        *                 description="User's name"
        *             )
        *         )
        *       ),
        *       @OA\Response(
        *           response="200",
        *           description="Successful create new Approver"
        *      ),
        *  )
        */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string'
            ]);

            $approver = $this->approverRepository->createApprover($data);

            return response()->json([
                'message' => 'Success create new Approver',
                'data' => $approver
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
