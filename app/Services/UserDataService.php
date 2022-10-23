<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class UserDataService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get Users List
     */
    public function get(): Paginator
    {
        return $this->userRepository->getUsersByQueryBuilder();
    }

    /**
     * Search for Users
     * 
     * @var array $criteria [firstName, lastName, email]
     */
    public function search($criteria): Paginator
    {
        return $this->userRepository->searchByQueryBuilder($criteria);
    }

    /**
     * Prepare data from different schema to be saved properly to database
     *
     * @param Response
     */
    public function prepareDataForUsers1($response1): Collection
    {
        $users = json_decode($response1->getBody(), true);
        $usersCollection = collect($users);

        $users = $usersCollection->map(function ($user) {
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

    /**
     * Prepare data from different schema to be saved properly to database
     *
     * @param Response
     */
    public function prepareDataForUsers2($response2): Collection
    {
        $users = json_decode($response2->getBody(), true);
        $usersCollection = collect($users);

        $users = $usersCollection->map(function ($user) {
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
}
