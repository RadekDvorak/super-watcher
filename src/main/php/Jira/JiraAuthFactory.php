<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Jira;



class JiraAuthFactory
{

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;



    /**
     * @param string $user
     * @param string $password
     */
    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }



    public function createAuthentication()
    {
        return new \Jira_Api_Authentication_Basic($this->user, $this->password);
    }

}
