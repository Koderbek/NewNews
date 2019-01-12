<?php
/**
 * Created by PhpStorm.
 * User: Profsoft
 * Date: 10.10.2018
 * Time: 19:57
 */

namespace App\Helper\Status;


class UserStatus extends AbstractStatus
{
    const ACTIVE = 1;
    const BLOCKED = 11;

    protected static $statusNames = [
        self::ACTIVE => 'Активен',
        self::BLOCKED => 'Заблокирован',
    ];
}