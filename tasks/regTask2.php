<?php
  
require_once(__DIR__.'/../vendor/autoload.php');  

use Cron\Schema\PhpSchema;
use Cron\Builder\Builder;
use Cron\Manager;


// -----------------------------------------------------------------------------
// CRON Registration 
// -----------------------------------------------------------------------------
  

// CRON Manage -----------------------------------------------------------------

$registry = __DIR__.'/../_registry/registry.sqlite';

(new Manager($registry))->register('task2_cron');


// CRON Schema -----------------------------------------------------------------

$task2 = 
(new PhpSchema())->timer('*','*','*','*','*')
              ->interpreter()
              ->command(__DIR__.'/task2.php')
              ->schema();


// CRON Create -----------------------------------------------------------------
    
(new Builder($task2))->create();