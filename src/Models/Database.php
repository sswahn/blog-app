<?php
/**
 * Database
 *
 */

namespace src\Models;

class Database
{
    private const HOST = 'localhost';

    private const PORT = '3306';

    private const NAME = 'dev_db';

    private const USER = 'root';

    private const PASS = 'root';

    public static function getConnection()
    {
        return new \PDO(
            'mysql:host='. self::HOST .';port='. self::PORT .';dbname='. self::NAME .';charset=utf8',
            self::USER, 
            self::PASS
        );
    }
}