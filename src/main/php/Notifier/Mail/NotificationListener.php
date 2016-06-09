<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Notifier\Mail;

use Kdyby\Events\Subscriber;
use RadekDvorak\SuperWatcher\Jira\Model\Issue;
use RadekDvorak\SuperWatcher\Notifier\SenderInterface;



class NotificationListener implements Subscriber
{

    /**
     * @var SenderInterface
     */
    private $sender;



    public function __construct(SenderInterface $sender)
    {
        $this->sender = $sender;
    }



    public function getSubscribedEvents(): array
    {
        return [
            'RadekDvorak\SuperWatcher\Jira\IssueWalker::onIssueFound' => 'notify',
        ];
    }



    /**
     * @param Issue $issue
     */
    public function notify(Issue $issue)
    {
        $this->sender->sendNotification($issue);
    }

}
