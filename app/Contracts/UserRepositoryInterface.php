<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
   public  function getUsersByQueryBuilder();
   public function getUsersByRawSql($page);

   public function searchByQueryBuilder($criteria);
   public function searchByRawSql($criteria);
}