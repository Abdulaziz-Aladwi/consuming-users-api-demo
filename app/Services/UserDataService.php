<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;

class UserDataService 
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get()
    {
        return $this->userRepository->getUsersByQueryBuilder();
    }

    public function search($criteria)
    {
        return $this->userRepository->searchByQueryBuilder($criteria);
    }

    public function prepareDataForUsers1($response1)
    {
        $users = json_decode($response1->getBody(), true);
        $usersCollection = collect($users);

        $users = $usersCollection->map(function($user){
            return [
                'first_name' => $user['firstName'],
                'last_name' => $user['lastName'],
                'email' => $user['email'],
                'avatar' => $user['avatar'],
                'created_at' => Carbon::now(),
            ];
        });

        return $users;
    }

    public function prepareDataForUsers2($response2)
    {
        $users = json_decode($response2->getBody(), true);
        $usersCollection = collect($users);

        $users = $usersCollection->map(function($user){
            return [
                'first_name' => $user['fName'],
                'last_name' => $user['lName'],
                'email' => $user['email'],
                'avatar' => $user['picture'],
                'created_at' => Carbon::now(),
            ];
        });

        return $users;
    }


    public function prepareDataForUsers3()
    {
            return [
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'aa@me.com',
                'avatar' => 'wqqrqwe',
                'created_at' => Carbon::now(),
            ];
        

    }

  
}