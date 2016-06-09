<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Notifier\Mail;

use RadekDvorak\SuperWatcher\Jira\Model\Issue;



class MailFactory
{

    /**
     * @var string
     */
    private $subject = 'Nové ASAP issue %s: %s';

    /**
     * @var string
     */
    private $body = <<<'EOS'
Přišel Ti nový ASAP úkol: %s od %s. Byl vytvořen v %s.

%s

%s

-- Tvůj supermanovský notifikátor ;-)
EOS;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $fromEmail;

    /**
     * @var string
     */
    private $toName;

    /**
     * @var string
     */
    private $toEmail;



    /**
     * @param string $fromName
     * @param string $fromEmail
     * @param string $toName
     * @param string $toEmail
     */
    public function __construct(
        string $fromName,
        string $fromEmail,
        string $toName,
        string $toEmail
    ) {

        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->toName = $toName;
        $this->toEmail = $toEmail;
    }



    /**
     * @param Issue $issue
     * @return \Swift_Mime_Message
     */
    public function createMessage(Issue $issue) :\Swift_Mime_Message
    {
        $subject = sprintf($this->subject, $issue->getKey(), $issue->getSummary());
        $args = [
            $issue->getKey(),
            $issue->getCreatedAt()->format('d.m.Y H:i:s'),
            $issue->getReporter()->getDisplayName(),
            $issue->getSummary(),
            $issue->getDescription()
        ];
        $body = vsprintf($this->body, $args);

        $message = \Swift_Message::newInstance($subject, $body);

        $message->setSender($this->fromEmail, $this->fromName);
        $message->setFrom($this->fromEmail, $this->fromName);

        $message->setTo($this->toEmail, $this->toName);

        return $message;
    }

}
