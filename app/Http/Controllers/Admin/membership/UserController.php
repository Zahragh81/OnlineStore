<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\UserRequest;
use App\Http\Resources\Admin\Membership\StoreResource;
use App\Http\Resources\Admin\Membership\UserResource;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('stores:id,title')
            ->select(['id', 'first_name', 'last_name', 'username', 'mobile'])
            ->where(fn($q) => $q->where('username', 'like', $this->search))
            ->orWhere('mobile', 'like', $this->search)
            ->paginate($this->first);

        return UserResource::collection($users);
    }


    public function store(UserRequest $request)
    {
        $inputs = $request->all();
        $user = User::create($inputs);

        if ($request->has('store_ids')) {
            $user->stores()->sync($request->input('store_ids'));
        }

        return self::successResponse();
    }


    public function show(User $user)
    {
        return new UserResource($user->load('stores:id,title'));
    }


    public function update(UserRequest $request, User $user)
    {
        $input = $request->all();
        $user->update($input);

        if ($request->has('store_ids')) {
            $user->stores()->sync($request->input('store_ids'));
        }

        return self::successResponse();
    }


    public function destroy(User $user)
    {
        $user->stores()->detach();

        $user->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'stores' => Store::select(['id', 'title'])->get()
        ]);
    }


    public function userStores()
    {
        $user = Auth::user();

        $stores = $user->stores()->with(['city:id,name', 'storeTypes:id,name', 'logo', 'banner'])->get();

        return self::successResponse([
            'stores' => StoreResource::collection($stores)
        ]);
    }
}
