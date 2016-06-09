<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher\Command;

use RadekDvorak\SuperWatcher\Jira\IssueWalker;
use RadekDvorak\SuperWatcher\Jira\Model\Issue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



class NotifySupermanCommand extends Command
{

    /**
     * @var IssueWalker
     */
    private $issueWalker;



    /**
     * @param IssueWalker $issueWalker
     */
    public function __construct(IssueWalker $issueWalker)
    {
        parent::__construct();

        $this->issueWalker = $issueWalker;
    }



    protected function configure()
    {
        $this
            ->setName('superman:notify')
            ->setDescription('Notify about superman issues');
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
            $this->issueWalker->onIssueFound[] = function (Issue $issue) use ($output) {
                $message = sprintf('Found issue %s', $issue->getKey());
                $output->writeln($message);
            };
        }

        $this->issueWalker->walkIssues();
    }

}
