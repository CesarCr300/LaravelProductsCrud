<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\TblProduct;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductService $service)
    {
        return response()->json($service->findAll(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductService $service)
    {
        try {
            $product = $service->create($request);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *u
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, ProductService $service)
    {
        $product = $service->findById($id);

        if ($product) {
            return response()->json($product, 200);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ProductService $service)
    {
        try {
            $product = $service->update($id, $request);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], $ex->getCode());
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductService $service)
    {
        try {
            $service->delete($id);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], $ex->getCode());
        }

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|gt:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return ['failed' => true, 'response' => ['message' => 'Los datos ingresados no son válidos', 'errors' => $validator->errors()]];
        }

        return ['failed' => false, 'response' => null,];
    }
}
