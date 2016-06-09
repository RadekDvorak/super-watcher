<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Notifier;

use RadekDvorak\SuperWatcher\Jira\Model\Issue;



interface SenderInterface
{

    /**
     * @param Issue $issue
     */
    public function sendNotification(Issue $issue);

}
