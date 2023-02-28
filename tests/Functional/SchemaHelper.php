<?php

declare(strict_types=1);

namespace App\Tests\Functional;

final class SchemaHelper
{
    public static function resetSchema(): void
    {
        shell_exec('php bin/console d:s:d --force --quiet');
        shell_exec('php bin/console d:s:u --force --complete --quiet');
        shell_exec('php bin/console app:load:fixtures');
    }
}
