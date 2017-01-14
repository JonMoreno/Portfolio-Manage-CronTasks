<?php

namespace Cron\Builder;

use Cron\Schema\SchemaInterface;

  
class Builder implements BuilderInterface
{
/*
|-------------------------------------------------------------------------------
| Class: Builder                                                      
|-------------------------------------------------------------------------------
| Purpose: 
| Create and delete cron jobs.
|
|
*/  
    
    protected $repo = '/tmp/crontab.txt';
    
    protected $cron;

    
    /**
    * Instatiate class
    * 
    * @param \Object $cron
    */
    public function __construct(SchemaInterface $cron)
    {
        
        $this->cron = $cron;
    }
    
    
    /**
    * Create cron with the desired schemma that was passed
    * through the constructor.
    * 
    */
    public function create()
    {
       
       $cmd = $this->cron->fullSchema; 
       $list = shell_exec('crontab -l');
       file_put_contents($this->repo, $list.$cmd.PHP_EOL);
       exec("crontab {$this->repo}");
    }
    
    
    /**
    * Delete ALL cron jobs.
    * 
    */
    public function destroy()
    {
        shell_exec('crontab -r');
    }

    
}