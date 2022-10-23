<?php

namespace App\Eloquent;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    const PAGINATION_COUNT = 10;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->tableName = $this->model->getTable();
    }

    public function getUsersByQueryBuilder()
    {
        return DB::table($this->tableName)->simplePaginate(self::PAGINATION_COUNT);
    }

    public function getUsersByRawSql($page)
    {
        $limit = self::PAGINATION_COUNT;
        $offset = $this->calculateOffset($page);
        return DB::select(DB::raw("SELECT * FROM users LIMIT {$limit} OFFSET {$offset}"));
    }

    public function searchByQueryBuilder($criteria = [])
    {
        $query = DB::table($this->tableName);

        if (isset($criteria['firstName'])) {
            $query->where('first_name', 'like', "%{$criteria['firstName']}%");
         }
 
         if (isset($criteria['lastName'])) {
            $query->where('last_name', 'like', "%{$criteria['lastName']}%");
        }
 
         if (isset($criteria['email'])) {
            $query->where('email', "{$criteria['email']}");
         }

         return $query->simplePaginate(self::PAGINATION_COUNT);
    }     

    public function searchByRawSql($criteria = [])
    {
        $rawQuery = "SELECT * FROM users";
        
        $bindingValues = [];
        
        if (isset($criteria['firstName'])) {
           $rawQuery.= " WHERE first_name like :firstName"; 
           $bindingValues = ['firstName' => "%{$criteria['firstName']}%" ];
           return DB::select(DB::raw($rawQuery), $bindingValues);
        }

        if (isset($criteria['lastName'])) {
            $rawQuery.= " WHERE last_name like :lastName"; 
            $bindingValues = ['lastName' => "%{$criteria['firstName']}%" ];
            return DB::select(DB::raw($rawQuery), $bindingValues);
        }

        if (isset($criteria['email'])) {
            $rawQuery.= " WHERE email like :email "; 
            $bindingValues = ['email' => $criteria['email']];
            return DB::select(DB::raw($rawQuery), $bindingValues);
        }
    }

    private function calculateOffset($page)
    {
        $limit = self::PAGINATION_COUNT;
        $offset = ($page * $limit) - $limit;

        return $offset;
    }
}
