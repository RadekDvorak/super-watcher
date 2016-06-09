<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Notifier\Mail;



use RadekDvorak\SuperWatcher\Jira\Model\Issue;
use RadekDvorak\SuperWatcher\Notifier\SenderInterface;



class Sender implements SenderInterface
{

    /**
     * @var MailFactory
     */
    private $mailFactory;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;



    /**
     * @param MailFactory $mailFactory
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        MailFactory $mailFactory,
        \Swift_Mailer $mailer
    ) {
        $this->mailFactory = $mailFactory;
        $this->mailer = $mailer;
    }



    /**
     * @param Issue $issue
     */
    public function sendNotification(Issue $issue)
    {
        $message = $this->mailFactory->createMessage($issue);
        $this->mailer->send($message, $failures);
    }

}
