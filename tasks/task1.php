<?php

require_once(__DIR__.'/../vendor/autoload.php');

use Cron\Manager;

$registry = __DIR__.'/../_registry/registry.sqlite';

(new Manager($registry))->run('task1_cron', 'unlock', 'localhost1');


// -----------------------------------------------------------------------------
//  Php script needed to complete the task.
//  Jobs can be either a php task or shell task.
// -----------------------------------------------------------------------------
// Example: shell task.

exec('touch ~/task1_running');
exec('open ~/task1_running');

