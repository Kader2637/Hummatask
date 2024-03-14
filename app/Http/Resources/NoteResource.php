<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'code' => $this->code,
            'tim_id' => $this->tim_id,
            'title' => $this->title,
            'type_note' => $this->type_note,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d F Y'),
            'note_detail' => $this->catatanDetail,
        ];
    }
}
