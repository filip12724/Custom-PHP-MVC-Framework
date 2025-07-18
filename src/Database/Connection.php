<?php
declare (strict_types = 1);

namespace Elephant\Framework\Database;

use PDO;

class Connection 
{
    private static $instance = null;
    public ?PDO $pdo = null;

    private function __construct(string $connectionString)
    {
        $this->pdo = new PDO($connectionString);
    }

    public static function create(string $connectionString): static
	{
		if (null === static::$instance) {
			static::$instance = new static($connectionString);
		}

		return static::$instance;
	}

    public static function getConnection()
    {
        return static::$instance;
    }
}