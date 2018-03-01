<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:06
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @param UserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request, UserService $service)
    {
        $username = $request->get('username');
        try {
            $user = $service->getOne($username, 'username');
            if (!$user->count()) {
                $user = $service->create(compact('username'));
            }
            $user = $user->createToken($username);
        } catch (\Exception $exception) {
            throw $exception;
        }
        return ResponseService::single($user->accessToken, 'token');
    }
}