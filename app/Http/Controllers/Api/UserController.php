<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserDataService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** @var UserRepositoryInterface  */
    private $userDataService;
    
    public function __construct(UserDataService $userDataService)
    {
        $this->userDataService = $userDataService;
    }

    public function list(Request $request)
    {
       return UserResource::collection($this->userDataService->get());  
    }

    public function search(Request $request)
    {
        $criteria = $request->all();
        return UserResource::collection($this->userDataService->search($criteria));
    }
}
