<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Jira\Model;



class Issue
{

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var Reporter
     */
    private $reporter;



    public function __construct(
        string $key,
        string $summary,
        string $description,
        \DateTime $createdAt,
        Reporter $reporter
    ) {
        $this->key = $key;
        $this->summary = $summary;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->reporter = $reporter;
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
    public function getSummary()
    {
        return $this->summary;
    }



    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }



    /**
     * @return Reporter
     */
    public function getReporter()
    {
        return $this->reporter;
    }

}
