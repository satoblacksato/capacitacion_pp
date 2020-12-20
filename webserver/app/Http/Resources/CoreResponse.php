<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CoreResponse extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'message' => 'DATA EXITOSA',
            'status' => 200,
            'errors' => [
                'general' => null,
                'trace' => null,
                'code' => null
            ],

        ];
    }
}
