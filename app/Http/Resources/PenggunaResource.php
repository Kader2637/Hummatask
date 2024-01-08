<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenggunaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'avatar' => ($this->avatar != null) ? asset($this->avatar) : asset('assets/img/avatars/1.png'),
            'username' => $this->username,
            'email' => $this->email,
            'divisi' => $this->divisi->name ?? "",
            'status' => $this->status,
            'sekolah' => $this->sekolah,
            'peran' => $this->peran->peran,
            'tlp' => $this->tlp,
            'deskripsi' => $this->deskripsi,
            'tanggal_bergabung' => $this->tanggal_bergabung,
            'tanggal_lulus' => $this->tanggal_lulus,
        ];
    }
}
