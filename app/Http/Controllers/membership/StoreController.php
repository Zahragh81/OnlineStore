<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\membership\StoreResource;
use App\Models\membership\City;
use App\Models\membership\Store;
use App\Models\membership\StoreType;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::select(['id', 'title', 'address', 'postal_code', 'latitude', 'longitude', 'mobile', 'phone', 'owner', 'city_id'])
            ->with(['city:id,name', 'storeTypes:id,name', 'logo', 'banner'])
            ->where(function ($q) {
                $q->where('title', 'like', $this->search);
            })->paginate($this->first);

        return StoreResource::collection($stores);
    }


    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        $store = Store::create($inputs);

        if ($request->has('storeType_ids')) {
            $store->storeTypes()->sync($request->input('storeType_ids'));
        }

        $basePath = jdate($store->created_at)->format('Y/m/d');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->extension();
            $path = "$basePath/store/$store->id/logo";

            Storage::putFileAs($path, $file, $filename);
            $store->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$filename",
                'type' => 'logo'
            ]);

        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');

            $filename = uniqid() . '.' . $file->extension();
            $path = "$basePath/Store/$store->id/banner";

            Storage::putFileAs($path, $file, $filename);

            $store->banner()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$filename",
                'type' => 'banner'
            ]);
        }

        return self::successResponse();
    }


    public function show(Store $store)
    {
        return new StoreResource($store->load(['city:id,name', 'storeTypes:id,name', 'logo', 'banner']));
    }


    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());

        if ($request->has('storeType_ids')) {
            $store->storeTypes()->sync($request->input('storeType_ids'));
        }

        $basePath = jdate($store->created_at)->format('Y/m/d');

        if ($request->hasFile('logo')) {
            $existingLogo = $store->logo;

            if ($existingLogo) {
                Storage::disk('public')->delete($existingLogo->path);
                $existingLogo->delete();
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->extension();
            $path = "$basePath/store/$store->id/logo";

            Storage::putFileAs($path, $file, $fileName);

            $store->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'logo'
            ]);
        }

        if ($request->hasFile('banner')) {
            $existingBanner = $store->banner;

            if ($existingBanner) {
                Storage::disk('public')->delete($existingBanner->path);
                $existingBanner->delete();
            }

            $file = $request->file('banner');
            $fileName = uniqid() . '.' . $file->extension();
            $path = "$basePath/store/$store->id/banner";

            Storage::putFileAs($path, $file, $fileName);

            $store->banner()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'banner'
            ]);
        }

        return self::successResponse();
    }


    public function destroy(Store $store)
    {
        $store->storeTypes()->detach();

        if ($store->logo) {
            $filePath = $store->logo->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $store->logo()->delete();
        }

        if ($store->banner) {
            $filePath = $store->banner->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $store->banner()->delete();
        }

        $store->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'storeTypes' => StoreType::select(['id', 'name'])->get(),
            'cites' => City::select(['id', 'name'])->get()
        ]);
    }
}
