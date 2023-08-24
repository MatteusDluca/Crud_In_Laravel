<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class UserController extends Controller
{
    public function __construct(
        protected User $user,
    ){}

    public function index()
    {
        $users = $this->user->paginate();
        return UserResource::collection($users);
    }


    public function store(StoreUpdateUserRequest $request){

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = $this->user->create($data);

        return new UserResource($user);
    }


    public function show(string $id){
        // $user = $this->user->find($id);
        // $user = $this->user->where('id', '=',$id)->first();
        // if (!$user){
            // return response()->json(['error' => 'User not found'], 404);

        $user = $this->user->findOrFail($id);

        return new UserResource($user);



        }



        public function update(StoreUpdateUserRequest $request, string $id)
        {
            $data = $request->all();
            if($request->password)
                $data['password'] = bcrypt($request->password);
            $user = $this->user->findOrFail($id);
            $user->update($data);

            return new UserResource($user);
        }


        public function destroy(string $id){
            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json(['success' => 'User deleted'], HttpResponse::HTTP_NO_CONTENT);
        }

    }

