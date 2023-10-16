<?php

namespace App\Http\Api;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAll(Request $request): JsonResponse
    {
        $response = [
            'status' => self::STATUS_FAIL
        ];
        $result = $this->userRepo->getAll($request->all());
        $total = $this->userRepo->getTotal($request->all());
        if (!empty($result)) {
            $response = [
                'status' => self::STATUS_SUCCESSFUL,
                'result' => $result,
                'total' => $total
            ];
        }
        return response()->json($response);
    }

    public function create(Request $request): JsonResponse
    {
        $response = [
            'status' => self::STATUS_FAIL
        ];
        $result = $this->userRepo->create($request->all());
        if (!empty($result)) {
            $response = [
                'status' => self::STATUS_SUCCESSFUL,
                'result' => $result
            ];
        }
        return response()->json($response);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $response = [
            'status' => self::STATUS_FAIL
        ];
        $result = $this->userRepo->edit($request->all(), $id);
        if (!empty($result)) {
            $response = [
                'status' => self::STATUS_SUCCESSFUL,
                'result' => $result
            ];
        }
        return response()->json($response);
    }
}
