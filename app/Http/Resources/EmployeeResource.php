<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'emp_code' => $this->emp_code,
            'full_name' => $this->full_name,
            'mobile' => $this->mobile,
            'dob' => $this->dob,
            'fathers_name' => $this->fathers_name,
            'gender' => $this->gender,
            'office_name' => $this->office_name,
            'district' => $this->district, // This is the string district name from employee table
            // 'district_relation' => new DxistrictResource($this->whenLoaded('districtRelation')), // If you had a relationship
            'designation' => $this->designation,
            'tribe_name' => $this->tribe_name,
            'district_id' => $this->district_id, // This is the string ID
            'photo_url' => $this->photo ? Storage::url($this->photo) : null, // Generate full URL for photo
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
