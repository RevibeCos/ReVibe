<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
//we want to know if the products here want pagination or not ??
    public function index()
    {
        $products = Product::latest();

        return response_api(true, 200, 'Products retrieved successfully', ProductResource::collection($products));
//            $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }


    public function store(Request $request)
    {
        //want to add rty catch in all functions in system to handle the programming error
        try {
            $input = $request->all();

            //want to be added in request file Api/CreateProductRequest
            $validator = Validator::make($input, [
                'name' => 'required',
                'detail' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            ////////

            $product = Product::create($input);

            return response_api(true, 200, new ProductResource($product));
//            $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        } catch (\Exception $e) {
            return response_api(false, 422, $e->getMessage(), empObj());
        }
    }


    public function show($id)
    {
        $product = Product::findorfail($id);

        if (is_null($product)) {
            return response_api(false, 400, message(400));
//                $this->sendError('Product not found.');
        }
        return response_api(true, 200, message(200), new ProductResource($product));
//        return $product;
//        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    public function update(Request $request, Product $product)
    {
        //edit this function add validation file in request ,add try catch ,edit response statement
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        try {
            if (isset($product) && $product->delete()) {
                return response_api(true, 200, __('app.deleted'), []);
            }
            return response_api(false, 422, null, []);
        } catch (\Exception $e) {
            return response_api(false, 422, $e->getMessage(), empObj());

        }
    }
}
