<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class UserController extends Controller
{
    public function __construct()
    {
        // Protect everything except listing & creation (adjust to your needs)
        $this->middleware('auth:sanctum')->except(['index', 'store', 'show', 'destroy']);
    }

    /**
     * GET /api/users
     * Paginated list (15 per page by default).
     */
    public function index(): JsonResponse
    {
        $users = User::paginate(15);

        return response()->json([
            'success' => true,
            'data'    => $users,
            'message' => 'Users retrieved successfully.',
        ]);
    }

    /**
     * POST /api/users
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User created successfully.',
        ], Response::HTTP_CREATED);   // 201
    }

    /**
     * GET /api/users/{id}
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'success' => true,
                'data'    => $user,
                'message' => 'User retrieved successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'User not found.',
            ], Response::HTTP_NOT_FOUND);   // 404
        }
    }

    /**
     * PUT /api/users/{id}
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->validated());

            return response()->json([
                'success' => true,
                'data'    => $user,
                'message' => 'User updated successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'User not found.',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * DELETE /api/users/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'data'    => null,
                'message' => 'User deleted successfully.',
            ], Response::HTTP_NO_CONTENT);   // 204
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'User not found.',
            ], Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'Could not delete user.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);   // 500
        }
    }
}
