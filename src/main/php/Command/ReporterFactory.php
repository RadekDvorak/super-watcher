<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Command;

use RadekDvorak\SuperWatcher\Jira\Model\Reporter;



class ReporterFactory
{

    public function createReporter(string $key, string $displayName, string $email): Reporter
    {
        return new Reporter($key, $displayName, $email);
    }

}
