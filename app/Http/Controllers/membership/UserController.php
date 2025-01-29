<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\membership\UserResource;
use App\Models\membership\Store;
use App\Models\User;

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
}
