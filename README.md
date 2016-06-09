Super Watcher
===================


Super watcher is a working prototype of application that monitors JIRA issues and sends notification. Any custom JQL query may be entered.

----------


Making it work
-------------

Getting super watcher work is straightforward:

 1. Get the souces
 2. Install dependencies via `composer.phar install`
 3. Copy `.env.example` to `.env` and fill all values

Then you can run superwatcher using `bin/notify-superman.sh`.

> **Note:**

> - Super Watcher is just a protype
> - Test it extensively before relying on it


#### Developer notes

 - Test are missing, I know, because...
 - ...I do not have a clean idea what it should do.
 - PSR style is preferred
 - Continuous integration is missing, I know.
 
