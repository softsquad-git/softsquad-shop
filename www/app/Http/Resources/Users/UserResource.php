<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['name'] = $this->specificData->name . ' ' . $this->specificData->last_name;
        $data['nick'] = $this->specificData->nick ?? '';
        return $data;
    }
}
