<?php

namespace App\Http\Resources\Customer\Membership\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
       return [
           'id' => $this->id,
           'path' => asset($this->path),
           'size' => number_format($this->size),
           'mime_type' => $this->mime_type,
           'type' => $this->type
       ];
    }
}
