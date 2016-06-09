<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Jira\Model;



class Reporter
{

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $emailAddress;



    public function __construct($key, $displayName, $emailAddress)
    {
        $this->key = $key;
        $this->displayName = $displayName;
        $this->emailAddress = $emailAddress;
    }



    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }



    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }



    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

}
