<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\CourierRequest;
use App\Http\Resources\Admin\Membership\CourierResource;
use App\Models\Courier;
use App\Models\CourierType;
use App\Models\User;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::select(['id', 'plate_number', 'vehicle_name', 'user_id', 'courier_type_id', 'status'])
            ->with(['user:id,first_name,last_name,username,mobile', 'courierType:id,name'])
            ->where(fn($q) => $q->where('plate_number', 'like', $this->search))
            ->paginate($this->first);

        return CourierResource::collection($couriers);
    }


    public function store(CourierRequest $request)
    {
        $input = $request->all();

        Courier::create($input);

        return self::successResponse();
    }


    public function show(Courier $courier)
    {
        return new CourierResource($courier->load(['user:id,first_name,last_name,username,mobile', 'courierType:id,name']));
    }


    public function update(CourierRequest $request, Courier $courier)
    {
        $input = $request->all();

        $courier->update($input);

        return self::successResponse();
    }


    public function destroy(Courier $courier)
    {
        $courier->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'users' => User::select(['id', 'username', 'first_name', 'last_name'])->get(),
            'courierTypes' => CourierType::select(['id', 'name'])->get()
        ]);
    }
}
