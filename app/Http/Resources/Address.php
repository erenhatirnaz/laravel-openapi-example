<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="Address",
 *      @OA\Property(property="id", type="integer", description="Address ID", example=1),
 *      @OA\Property(property="type", type="string", enum={"home", "work", "other"}, description="Type", example="home"),
 *      @OA\Property(property="title", type="string", minLength=2, description="Title", example="Ev adresim"),
 *      @OA\Property(property="address", type="string", minLength=10, description="Address", example="Bahçeşehir 2. Kısım 12. Caddesi no: 12I İstanbul Başakşehir"),
 *      @OA\Property(property="address_recipe", type="string", minLength=2, description="Address recipe", example="erdal bakkal karşısı"),
 *      @OA\Property(property="lat_long", type="string", description="Coordinates, Format: LAT, LONG", example="41.08442, 28.67263"),
 *      @OA\Property(property="city", type="string", description="City", example="İstanbul"),
 *      @OA\Property(property="county", type="string", description="County", example="Başakşehir"),
 * )
 */
class Address extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'type'           => $this->type,
            'title'          => $this->title,
            'address'        => $this->address,
            'address_recipe' => $this->address_recipe,
            'lat_long'       => $this->lat_long,
            'city'           => $this->city,
            'county'         => $this->county,
        ];
    }
}
