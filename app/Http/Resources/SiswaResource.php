<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'avatar' => storage_path().$this->avatar,
            'username' => $this->username,
            'email' => $this->email,
            'divisi' => [
                'id' => $this->divisi_id,
                'name' => $this->divisi->name,
            ],
            'status' => $this->status,
            'sekolah' => $this->sekolah,
            'peran' => [
                'id' => $this->peran_id,
                'name' => $this->peran->peran,
            ],
            'tlp' => $this->tlp,
            'deskripsi' => $this->desripsi,
            'tanggal_bergabung' => $this->tanggal_bergabung,
            'tanggal_lulus' => $this->tanggal_lulus
        ];
    }
}
