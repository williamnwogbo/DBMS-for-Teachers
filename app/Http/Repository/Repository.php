<?php

namespace App\Http\Repository;

use App\Models\Teacher;

class Repository
{
    static
        $teacher;

    function __construct()
    {
        self::$teacher 		= new Teacher();
    }
}

