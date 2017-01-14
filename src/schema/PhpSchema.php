<?php
  
namespace Cron\Schema;

  
class PhpSchema extends AbstractSchema implements SchemaInterface
{
/*
|-------------------------------------------------------------------------------
| Class: PhpSchema                                                     
|-------------------------------------------------------------------------------
| Purpose: 
| Define a cron schema/layout that supports php cron jobs.
|
|
*/    
   
    
    /**
    * Provide location of php interpreter otherwise 
    * class will attemp to configure one.
    * 
    * @param string $interprater
    * @return \Cron\Schema\PhpSchema
    */
    public function interpreter($interprater = null)
    {
        if(!empty($interprater))
        {
            $this->interpreter = $interprater;

        }
        $this->interpreter = trim(preg_replace('/\s\s+/', ',' , shell_exec('which php')));
        return $this;
    }
    
    
    /**
    * Location of php file needed to run cron job.
    * 
    * @param string $file
    * @return \Cron\Schema\PhpSchema
    */
    public function command($file)
    {
        $this->command= $file;
        return $this;
    }
    
    
    /**
    * Deliver a full schema/layout of cron job.
    * 
    * @return \Cron\Schema\PhpSchema
    */
    public function schema()
    {
        $timer = $this->timer;
        $interpreter = $this->interpreter;
        $command = $this->command;
        
        $this->fullSchema = trim("{$timer} {$interpreter} {$command}");
        
        return $this;
    }

    public function __destruct() 
    {
        var_dump($this);
    }
    
}