<?php

namespace App\Http\Controllers\admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\ProductNatureRequest;
use App\Http\Resources\ProductNatureResource;
use App\Models\ProductNature;
use App\Models\ProductNatureAttribute;
use App\Models\StoreType;
use Illuminate\Support\Facades\Storage;

class ProductNatureController extends Controller
{
    public function index()
    {
        $productNatures = ProductNature::select(['id', 'name', 'store_type_id', 'status'])
            ->with(['logo', 'productNatureAttributes:id,name', 'storeType:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return ProductNatureResource::collection($productNatures);
    }


    public function store(ProductNatureRequest $request)
    {
        $input = $request->all();
        $productNature = ProductNature::create($input);

        if ($request->has('productNatureAttributes')) {
            $attributes = [];
            foreach ($request->input('productNatureAttributes') as $attribute) {
                $attributes[$attribute['productNatureAttributeId']] = ['admin_panel' => $attribute['admin_panel']];
            }

            $productNature->productNatureAttributes()->sync($attributes);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($productNature->created_at)->format('Y/m/d');
            $path = "$basePath/productNature/$productNature->id/logo";

            Storage::putFileAs($path, $file, $fileName);
            $productNature->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'logo'
            ]);
        }

        return self::successResponse();
    }


    public function show(ProductNature $productNature)
    {
        return new ProductNatureResource($productNature->load(['logo', 'productNatureAttributes:id,name', 'storeType:id,name']));
    }


    public function update(ProductNatureRequest $request, ProductNature $productNature)
    {
        $input = $request->all();

        $productNature->update($input);

        if ($request->has('productNatureAttributes')) {
            $attributes = [];
            foreach ($request->input('productNatureAttributes') as $attribute) {
                $attributes[$attribute['productNatureAttributeId']] = ['admin_panel' => $attribute['admin_panel']];
                $productNature->productNatureAttributes()->sync($attributes);
            }
        }

        if ($request->hasFile('logo')) {
            $existingLogo = $productNature->logo;

            if ($existingLogo) {
                Storage::disk('public')->delete($existingLogo->path);
                $existingLogo->delete();
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($productNature->created_at)->format('Y/m/d');
            $path = "$basePath/productNature/$productNature->id/logo";

            Storage::putFileAs($path, $file, $fileName);

            $productNature->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'logo'
            ]);
        }

        return self::successResponse();
    }


    public function destroy(ProductNature $productNature)
    {
        $productNature->productNatureAttributes()->detach();

        if ($productNature->logo) {
            $filePath = $productNature->logo->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $productNature->logo()->delete();
        }

        $productNature->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'ProductNatureAttributes' => ProductNatureAttribute::select(['id', 'name'])->get(),
            'StoreTypes' => StoreType::select(['id', 'name'])->get()
        ]);
    }
}
