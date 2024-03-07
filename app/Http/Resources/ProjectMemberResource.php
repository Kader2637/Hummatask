<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'jabatan' => $this->jabatan->nama_jabatan,
            'status' => $this->status,
            'avatar' => $this->user->avatar ? asset('storage/' . $this->user->avatar) : asset('assets/img/avatars/1.png'),
            'name' => $this->user->username,
        ];
    }
}
