<?php
  
namespace Cron\Schema;


abstract class AbstractSchema 
{
/*
|-------------------------------------------------------------------------------
| Class: SchemaInterface                                                      
|-------------------------------------------------------------------------------
| Purpose: 
| Define common properties and methods a cron schema/layout needs.
|
|
*/
    
    protected $timer;
    
    protected $interpreter;
    
    public $command;
    
    public $fullSchema;

    
   /**
    * Optional: timer can be pass via the constructor.
    * 
    * @param string $minute
    * @param string $hour
    * @param string $dayOfMonth
    * @param string $month
    * @param string $dayOfWeek
    */
    public function __construct($minute='*',$hour='*',$dayOfMonth='*',$month='*',$dayOfWeek='*')
    {
       $this->timer = sprintf(
            ' %s %s %s %s %s ',
            $minute,
            $hour,
            $dayOfMonth,
            $month,
            $dayOfWeek
        );

    }
    
   
   /**
    * Set up timer for cron job.
    * 
    * @param type $minute
    * @param type $hour
    * @param type $dayOfMonth
    * @param type $month
    * @param type $dayOfWeek
    * @return \Cron\Schema\AbstractSchema
    */
    public function timer($minute='*',$hour='*',$dayOfMonth='*',$month='*',$dayOfWeek='*')
    {
       $this->timer = sprintf(
            ' %s %s %s %s %s ',
            $minute,
            $hour,
            $dayOfMonth,
            $month,
            $dayOfWeek
        ); 
        return $this;
    }
    
    /**
    *  Command cron job must execute.
    */
    abstract public function command($file);
    
    
    /**
    *  Schmea/layout of cron job.
    */
    abstract public function schema();
    
    
}