<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\ProductRequest;
use App\Http\Resources\Admin\Membership\ProductNatureResource;
use App\Http\Resources\Admin\Membership\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductNature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select(['id', 'name', 'product_introduction', 'product_nature_id', 'brand_id'])
            ->with(['productNature:id,name', 'brand:id,name', 'productFeatureValues', 'files'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search)
                    ->orWhereHas('brand', function ($query) {
                        $query->where('name', 'like', $this->search);
                    });
            })
            ->paginate($this->first);

        return ProductResource::collection($products);
    }


    public function store(ProductRequest $request)
    {
        $input = $request->all();

        $product = Product::create($input);

        if ($request->has('productFeatureValues')) {
            foreach ($request->input('productFeatureValues') as $featureValue) {
                $product->productFeatureValues()->create([
                    'product_nature_attribute_id' => $featureValue['product_nature_attribute_id'],
                    'value' => $featureValue['value'],
                    'product_id' => $product->id,
                ]);
            }
        }

        if ($request->has('similarProducts')) {
            $product->similarProducts()->sync($request->input('similarProducts'));
        }

        if ($request->has('relatedProducts')) {
            $product->relatedProducts()->sync($request->input('relatedProducts'));
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($product->created_at)->format('Y/m/d');
                $path = "$basePath/product/$product->id";

                Storage::putFileAs($path, $file, $fileName);

                $product->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName",
                    'type' => 'files'
                ]);
            }
        }

        return self::successResponse();
    }


    public function show(Product $product)
    {
        return new ProductResource($product->load(['productNature:id,name', 'brand:id,name', 'productFeatureValues', 'files']));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $input = $request->all();

        $product->update($input);

        if ($request->has('productFeatureValues')) {
            foreach ($request->input('productFeatureValues') as $featureValue) {
                $existingFeatureValue = $product->productFeatureValues()
                    ->where('product_nature_attribute_id', $featureValue['product_nature_attribute_id'])
                    ->first();

                if ($existingFeatureValue) {
                    $existingFeatureValue->update([
                        'value' => $featureValue['value'],
                    ]);
                } else {
                    $product->productFeatureValues()->create([
                        'product_nature_attribute_id' => $featureValue['product_nature_attribute_id'],
                        'value' => $featureValue['value'],
                        'product_id' => $product->id,
                    ]);
                }
            }
        }

        if ($request->has('similarProducts')) {
            $product->similarProducts()->sync($request->input('similarProducts'));
        }

        if ($request->has('relatedProducts')) {
            $product->relatedProducts()->sync($request->input('relatedProducts'));
        }

        if ($request->hasFile('files')) {
            $existingFiles = $product->files;

            foreach ($existingFiles as $existingFile) {
                Storage::disk('public')->delete($existingFile->path);
                $existingFile->delete();
            }

            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($product->created_at)->format('Y/m/d');
                $path = "$basePath/product/$product->id";

                Storage::putFileAs($path, $file, $fileName);

                $product->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName",
                    'type' => 'files'
                ]);
            }
        }
        return self::successResponse();
    }

    public function destroy(Product $product)
    {
        if ($product->productFeatureValues) {
            foreach ($product->productFeatureValues as $featureValue) {
                $product->productFeatureValues()->detach($featureValue->id);

                $featureValue->delete();
            }
        }

        $product->similarProducts()->detach();
        $product->relatedProducts()->detach();

        if ($product->files) {
            foreach ($product->files as $file) {
                if (Storage::disk('public')->exists($file->path)) {
                    Storage::disk('public')->delete($file->path);
                }

                $file->delete();
            }
        }

        $product->delete();

        return self::successResponse();
    }


    public function productNatureAttribute(Request $request)
    {
        $productNatureId = $request->input('product_nature_id');

        if ($productNatureId) {
            $productNature = ProductNature::with([
                'productNatureAttributes' => fn($q) => $q->wherePivot('admin_panel', true)
                    ->with('productNatureAttributeItems:id,name')
            ])->findOrFail($productNatureId);

            $relatedProducts = Product::select(['id', 'name'])
                ->where('product_nature_id', $productNatureId)
                ->whereHas('relatedProducts', fn($q) => $q->where('product_nature_id', $productNatureId))
                ->get();

            $similarProducts = Product::select(['id', 'name'])
                ->where('product_nature_id', $productNatureId)
                ->whereHas('similarProducts', fn($q) => $q->where('product_nature_id', $productNatureId))
                ->get();
        } else {
            $relatedProducts = collect();
            $similarProducts = collect();
        }

        return self::successResponse([
            'productNature' => new ProductNatureResource($productNature),
            'relatedProducts' => ProductResource::collection($relatedProducts),
            'similarProducts' => ProductResource::collection($similarProducts),
        ]);
    }


    public function upsertData()
    {
        return self::successResponse([
            'productNatures' => ProductNature::select(['id', 'name'])->get(),
            'brands' => Brand::select(['id', 'name'])->get(),
        ]);

    }
}
