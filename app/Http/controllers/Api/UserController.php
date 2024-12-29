<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function index(Request $request)
    {
        $params = $request->all();

        $data = User::query()
            ->when(!empty($params['role']), function (Builder $query) use ($params) {
                $query->whereHas('roles', function ($q) use ($params) {
                    $q->where('name', $params['role']);
                });
            })
            ->when(!empty($params['keyword']), function (Builder $query) use ($params) {
                $query->where(function ($q) use ($params) {
                    $q->where('firstname', 'like', '%' . $params['keyword'] . '%')
                        ->orWhere('lastname', 'like', '%' . $params['keyword'] . '%')
                        ->orWhere('reference', 'like', '%' . $params['keyword'] . '%')
                        ->orWhere('email', 'like', '%' . $params['keyword'] . '%');
                });
            })
            ->paginate($params['per_page'] ?? 10);

        return UserResource::collection($data);
    }

    public function getStats(Request $request): Response
    {

        $params = $request->all();

        return response($this->userService->getStats($params), Response::HTTP_OK);
    }


    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $user = $this->userService->createNewTenantUser($request);
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {

        $user = $this->userService->updateUser($id, $request);

        return new UserResource($user);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function assignRoles(Request $request, User $user)
    {
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);

        return response()->json(['message' => 'Roles assigned successfully']);
    }

}
