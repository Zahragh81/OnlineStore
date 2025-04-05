<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\CityRequest;
use App\Http\Resources\Admin\Membership\CityResource;
use App\Models\City;
use App\Models\Province;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::select(['id', 'name', 'parent_id', 'status'])
            ->with(['province'])
            ->where(fn($q) => $q->where('name', 'like', $this->search))
            ->paginate($this->first);

        return CityResource::collection($cities);
    }


    public function store(CityRequest $request)
    {
        $input = $request->all();

        City::create($input);

        return self::successResponse();
    }


    public function show(City $city)
    {
        return new CityResource($city->load('province'));
    }


    public function update(CityRequest $request, City $city)
    {
        $input = $request->all();

        $city->update($input);

        return self::successResponse();
    }


    public function destroy(City $city)
    {
        $city->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'provinces' => Province::select(['id', 'name'])->get()
        ]);
    }
}
