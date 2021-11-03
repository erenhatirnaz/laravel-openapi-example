<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Http\Resources\Address as AddressResource;
use Illuminate\Http\Request;

/**
 * @OA\Parameter(
 *      parameter="AddressId",
 *      description="Address ID",
 *      in="path",
 *      name="id",
 *      @OA\Schema(type="integer"),
 *      required=true,
 *      example=1,
 * )
 *
 * @OA\Examples(
 *      example="AddressNotFound",
 *      summary="Address not found",
 *      value={"code": "common.not-found", "message": "Address not found."},
 * )
 */
class AddressController extends Controller
{
    /**
     * Index
     *
     * @OA\Get(
     *      path="/api/address",
     *      tags={"Address"},
     *      security={{ "token": {} }},
     *      @OA\Response(response=401, ref="#/components/responses/UnauthorizedError"),
     *      @OA\Response(
     *          response=200,
     *          description="List of addresses that belongs to the logged in user",
     *          @OA\JsonContent(
     *              allOf={@OA\Schema(ref="#/components/schemas/Success")},
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Address"))
     *          )
     *      )
     * )
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $user = $request->user();
        $addresses = $user->addresses;

        return response()->json(['code' => 'success' ,'data' => AddressResource::collection($addresses)]);
    }


    /**
     * Create
     *
     * @OA\Post(
     *      path="/api/address",
     *      tags={"Address"},
     *      security={{ "token": {} }},
     *      @OA\RequestBody(ref="#/components/requestBodies/Address"),
     *      @OA\Response(response=401, ref="#/components/responses/UnauthorizedError"),
     *      @OA\Response(
     *          response=201,
     *          description="Address created successfully",
     *          @OA\JsonContent(
     *              allOf={@OA\Schema(ref="#/components/schemas/Success")},
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/Address"),
     *          )
     *      )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $user = $request->user();

        $address = $user->addresses()->create($request->input());

        return response()->json(['code' => 'success', 'data' => new AddressResource($address)], 201);
    }

    /**
     * Show
     *
     * @OA\Get(
     *      path="/api/address/{id}",
     *      tags={"Address"},
     *      security={{ "token": {} }},
     *      @OA\Parameter(ref="#/components/parameters/AddressId"),
     *      @OA\Response(response=401, ref="#/components/responses/UnauthorizedError"),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Error",
     *              examples={
     *                  @OA\Examples(example="AddressNotFound", ref="#/components/examples/AddressNotFound"),
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              allOf={@OA\Schema(ref="#/components/schemas/Success")},
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
     *          )
     *      )
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $address = $user->addresses()->find($id);
        if (!$address) {
            return response()->json(['code' => 'not-found', 'message' => 'Address not found!']);
        }

        return response()->json(['code' => 'success', 'data' => new AddressResource($address)]);
    }


    /**
     * Update
     *
     * @OA\Put(
     *      path="/api/address/{id}",
     *      tags={"Address"},
     *      security={{ "token": {} }},
     *      @OA\Parameter(ref="#/components/parameters/AddressId"),
     *      @OA\RequestBody(ref="#/components/requestBodies/Address"),
     *      @OA\Response(response=401, ref="#/components/responses/UnauthorizedError"),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Error",
     *              examples={
     *                  @OA\Examples(example="AddressNotFound", ref="#/components/examples/AddressNotFound"),
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Address updated successfully",
     *          @OA\JsonContent(
     *              allOf={@OA\Schema(ref="#/components/schemas/Success")},
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/Address"),
     *          )
     *      )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $user = $request->user();

        $address = $user->addresses()->find($id);
        if (!$address) {
            return response()->json(['code' => 'not-found', 'message' => 'Address not found!']);
        }

        $address->update($request->input());

        return response()->json(['code' => 'success', 'data' => new AddressResource($address)], 200);
    }

    /**
     * Delete
     *
     * @OA\Delete(
     *      path="/api/address/{id}",
     *      tags={"Address"},
     *      security={{ "token": {} }},
     *      @OA\Parameter(ref="#/components/parameters/AddressId"),
     *      @OA\Response(response=401, ref="#/components/responses/UnauthorizedError"),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Error",
     *              examples={
     *                  @OA\Examples(example="AddressNotFound", ref="#/components/examples/AddressNotFound"),
     *              }
     *          )
     *      ),
     *      @OA\Response(response=204, description="Address deleted successfully."),
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        $address = $user->addresses()->find($id);
        if (!$address) {
            return response()->json(['code' => 'not-found', 'message' => 'Address not found!']);
        }

        $user->addresses()->delete($id);

        return response('', 204);
    }
}
