<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Command;

use RadekDvorak\SuperWatcher\Jira\Model\Issue;
use RadekDvorak\SuperWatcher\Jira\Model\Reporter;



class IssueFactory
{

    /**
     * @param string $key
     * @param string $summary
     * @param string $description
     * @param string $createdDate
     * @param Reporter $reporter
     * @return Issue
     */
    public function createIssue(
        string $key,
        string $summary,
        string $description,
        string $createdDate,
        Reporter $reporter
    ): Issue
    {
        $createdAt = new \DateTime($createdDate);

        return new Issue($key, $summary, $description, $createdAt, $reporter);
    }

}
