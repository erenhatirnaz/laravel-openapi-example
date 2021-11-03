<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *      request="Address",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"type","title","address","address_recipe","lat_long","city","county"},
 *          @OA\Property(property="type", ref="#/components/schemas/Address/properties/type"),
 *          @OA\Property(property="title", ref="#/components/schemas/Address/properties/title"),
 *          @OA\Property(property="address", ref="#/components/schemas/Address/properties/address"),
 *          @OA\Property(property="address_recipe", ref="#/components/schemas/Address/properties/address_recipe"),
 *          @OA\Property(property="lat_long", ref="#/components/schemas/Address/properties/lat_long"),
 *          @OA\Property(property="city", ref="#/components/schemas/Address/properties/city"),
 *          @OA\Property(property="county", ref="#/components/schemas/Address/properties/county"),
 *      )
 * )
 */
class AddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type'           => 'required|in:home,work,other',
            'title'          => 'required|min:2',
            'address'        => 'required|min:10',
            'address_recipe' => 'required|min:2',
            'lat_long'       => 'required',
            'city'           => 'required',
            'county'         => 'required',
        ];
    }
}
