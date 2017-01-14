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

(new Manager($registry))->register('task1_cron');


// CRON Schema -----------------------------------------------------------------

$task1 = 
(new PhpSchema())->timer('*','*','*','*','*')
              ->interpreter()
              ->command(__DIR__.'/task1.php')
              ->schema();


// CRON Create -----------------------------------------------------------------
    
(new Builder($task1))->create();