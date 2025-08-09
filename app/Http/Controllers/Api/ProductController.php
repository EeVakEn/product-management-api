<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        collect($request->only(['category', 'in_stock']))->each(function ($value, $key) use (&$query) {
            match ($key) {
                'category' => $query->where('category', $value),
                'in_stock' => $query->where('in_stock', filter_var($value, FILTER_VALIDATE_BOOLEAN)),
                default => null,
            };
        });

        $products = $query->paginate(10);
        $totalValue = Product::where('in_stock', true)->count();

        return ProductResource::collection($products)
            ->additional([
                'total_in_stock_value' => $totalValue,
            ]);
    }

    public function store(StoreRequest $request)
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
