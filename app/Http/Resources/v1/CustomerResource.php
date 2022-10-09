<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name_customer' => $this->name,
            'phone_customer' => $this->phone,
            'email_customer' => $this->email,
            'address_customer' => $this->address,
            'city_customer' => $this->city,
        ];
        // return parent::toArray($request);
    }
}
