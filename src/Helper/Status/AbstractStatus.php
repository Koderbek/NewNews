<?php
/**
 * Created by PhpStorm.
 * User: Profsoft
 * Date: 27.09.2018
 * Time: 12:05
 */

namespace App\Helper\Status;


abstract class AbstractStatus
{
    const ACTIVE = 1;
    const BLOCKED = 11;
    const DISMISSED = 21;

    protected static $statusNames = [
        self::ACTIVE => 'Активен',
        self::BLOCKED => 'Неактивен',
        self::DISMISSED => 'Уволен',
    ];

    protected static $statusTypes = [
        self::ACTIVE => 'primary',
        self::BLOCKED => 'warning',
        self::DISMISSED => 'danger',
    ];

    public static function getName($key)
    {
        if (isset(static::$statusNames)) {
            if (array_key_exists($key, static::$statusNames)) {
                return static::$statusNames[$key];
            }
        }

        return '';
    }

    public static function getType($key)
    {
        if (isset(static::$statusTypes)) {
            if (array_key_exists($key, static::$statusTypes)) {
                return static::$statusTypes[$key];
            }
        }

        return '';
    }

    public static function getStatusNames()
    {
        return static::$statusNames;
    }
}