<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Jira;

use Jira_Api;
use Jira_Issues_Walker;
use Nette\Object;
use RadekDvorak\SuperWatcher\Command\IssueFactory;
use RadekDvorak\SuperWatcher\Command\ReporterFactory;
use RadekDvorak\SuperWatcher\Jira\Model\Issue;



/**
 * @method onIssueFound(Issue $issue)
 * @method onWalkFinished()
 */
class IssueWalker extends Object
{

    /**
     * @var \Closure
     */
    public $onIssueFound = [];

    /**
     * @var \Closure
     */
    public $onWalkFinished = [];

    /**
     * @var string
     */
    private $query;

    /**
     * @var Jira_Issues_Walker
     */
    private $walker;

    /**
     * @var IssueFactory
     */
    private $issueFactory;

    /**
     * @var ReporterFactory
     */
    private $reporterFactory;



    /**
     * @param Jira_Api $jiraApi
     * @param IssueFactory $issueFactory
     * @param ReporterFactory $reporterFactory
     * @param string $query
     */
    public function __construct(
        Jira_Api $jiraApi,
        IssueFactory $issueFactory,
        ReporterFactory $reporterFactory,
        string $query
    ) {
        $this->walker = new Jira_Issues_Walker($jiraApi);
        $this->issueFactory = $issueFactory;
        $this->reporterFactory = $reporterFactory;
        $this->query = $query;
    }



    public function walkIssues()
    {
        $this->walker->push($this->query, 'summary,description,reporter,created');

        foreach ($this->walker as $found) {
            /** @var \Jira_Issue $found */
            $reporter = $this->reporterFactory->createReporter(
                $found->getReporter()['key'],
                $found->getReporter()['displayName'],
                $found->getReporter()['emailAddress']
            );

            $issue = $this->issueFactory->createIssue(
                $found->getKey(),
                $found->getSummary(),
                $found->getDescription(),
                $found->getCreated(),
                $reporter
            );

            $this->onIssueFound($issue);
        }

        $this->onWalkFinished();
    }

}
