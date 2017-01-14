<?php

require_once (__DIR__.'/vendor/autoload.php');
// Psr-4 Autloading 

/* 
 |-----------------------------------------------------|
 | EXAMPLES: are located in the cron/tasks/ directory. |
 |-----------------------------------------------------|
 | Run files regTask1.php and regTask2.php either
 | in the command line or browser.
 |
 | Command Line Ex:
 | $ php regTask1.php
 |
 | Expected output:
 
 * 
  class Cron\Schema\PhpSchema#3 (4) {
  protected $timer =>
  string(11) " * * * * * "
  protected $interpreter =>
  string(45) "/usr/local/php5-7.0.7-20160526-160257/bin/php"
  public $command =>
  string(16) "path/to/job/file"
  public $fullSchema =>
  string(73) "* * * * *  /usr/local/php5-7.0.7-20160526-160257/bin/php path/to/job/file"
  }
 
 
*/
