<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ApprovalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => [
                'id' => $this->status->id,
                'name' => $this->status->name
            ],
            'approver' => [
                'id' => optional($this->approvalStage->approver)->id,
                'name' => optional($this->approvalStage->approver)->name,
            ]
        ];
    }
}
