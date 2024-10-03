<?php
namespace App\Services;
use App\Models\TblProduct;
use Request;
use Validator;

class ProductService
{
    public function create($request)
    {
        $this->validateRequest($request);
        $product = TblProduct::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
        ]);
        return $product;
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
            throw new \Exception($validator->errors());
        }
    }
}