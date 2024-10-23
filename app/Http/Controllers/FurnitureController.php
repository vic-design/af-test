<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Http\Requests\FilterFurnitureRequest;
use App\Models\Furniture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(FilterFurnitureRequest $request): JsonResponse
    {
        $furniture = Furniture::query();        
        if($request->get('available')) {
            $furniture = $furniture->available();
        }
        $priceGT = $request->get('price_gt');
        $priceLT = $request->get('price_lt');
        if($priceGT) {
            $furniture = $furniture->priceGT($priceGT);
        }
        if($priceLT) {
            $furniture = $furniture->priceLT($priceLT);
        }
        return response()->json($furniture->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFurnitureRequest $request
     * @return JsonResponse
     */
    public function store(StoreFurnitureRequest $request): JsonResponse
    {
        $furniture = Furniture::query()->create($request->all());

        return response()->json(['message' => 'Furniture created successfully.', 'furniture' => $furniture]);
    }

    /**
     * Display the specified resource.
     *
     * @param Furniture $furniture
     * @return JsonResponse
     */
    public function show(Furniture $furniture): JsonResponse
    {
        return response()->json($furniture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFurnitureRequest $request
     * @param Furniture $furniture
     * @return JsonResponse
     */
    public function update(UpdateFurnitureRequest $request, Furniture $furniture): JsonResponse
    {
        $furniture->update($request->all());

        return response()->json(['message' => 'Furniture updated successfully.', 'furniture' => $furniture]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Furniture $furniture
     * @return JsonResponse
     */
    public function destroy(Furniture $furniture): JsonResponse
    {
        $furniture->delete();

        return response()->json(['message' => 'Furniture deleted successfully.']);
    }
}
