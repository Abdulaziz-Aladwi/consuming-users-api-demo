<?php
namespace App\Constants;

final class UserEndpoints {
    
    const users_1 = 'users_1';
    const users_2 = 'user_2';

    public static function getEndPoints()
    {
        return [
            'users_1' => self::users_1,
            'users_2' => self::users_2,
        ];
    }

}