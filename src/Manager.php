<?php

namespace Cron;


class Manager
{
/*
|-------------------------------------------------------------------------------
| Class: SchemaInterface                                                      
|-------------------------------------------------------------------------------
| Purpose: 
| Very simple class thant will register, validate and run cron job.
| Mostly for demonstrational purpose however class needs decoupling.
| This class uses sqlite3 but again is only for demonstrational puposes.
| MySql will be the one use for production because it offers better features
| like row locking and multithreating.
|
|
*/
    
    
    protected $registry;
    
    private $book; 
    
    protected $cron;

    protected $uniqueName;
    
    protected $timer;
    
    protected $interpreter;
    
    protected $script;


   /**
    * Database used as arbiter.
    * 
    * @param string $registry
    */
    public function __construct($registry)
    {
 
       $this->book = new \SQLite3($registry);    
    }

    
    /**
    * Register cron job into db.
    * A unique name must be given that does not already exist.
    * This method works in correlation to method run(). 
    * 
    * @param string $uniqueName
    */
    public function register($uniqueName)
    {
        $query = 
            "INSERT INTO crons_lock( name, state) 
            VALUES( '{$uniqueName}' , 'locked')";
            
        if( $this->validate($uniqueName) === 1)
        {
            var_dump('Cron already registerd');
        }
        elseif(!$result = $this->book->exec($query)) {
            
            die('CronERROR: could not be registered  '
                . 'CronHELP: rollback to re-register cron ');
        }
        
    }
    
    
   /**
    * If for some reason cron could not be register method
    * will attempt to register again.
    * 
    * @param string $uniqueName
    */
    public function rollback($uniqueName)
    {
        $rollback = "DELETE FROM crons_lock WHERE state='locked' AND name='{$uniqueName}'";
            
        if($this->book->exec($rollback)) {
            die("Cron: [{$uniqueName}] registration has been rolled back.  "); 
        }
    }
    
    /**
    * Check cron job is registerd.
    * 
    * @param string $uniqueName
    * @return type
    */
    public function validate($uniqueName)
    {
        $query =
            "SELECT count(*) FROM crons_lock WHERE name = '{$uniqueName}' AND state = 'locked'";
        
        $result = $this->book->query($query);
        
        $rows = $result->fetchArray();
        
        return $rows['count(*)'];
        
    }
    
    /**
    * This method works in correlation to register().
    * Place run() in file where cron job will be executed.
    * the name given must match the one used to register
    * the cron job.
    *
    * @param string $uniqueName
    * @param string $state
    * @param string $host
    * @return typy boolean
    */
    public function run($uniqueName, $state, $host)
    {
        $this->uniqueName = $uniqueName;
        
        if($this->validate($uniqueName) !== 1) {
            
           exec("touch cron_{$uniqueName}failed.txt"); 
           exec("open  cron_{$uniqueName}failed.txt");
                      
        }
        else {
            $update = $this->book->exec(
                "UPDATE crons_lock SET state = '{$state}', host='{$host}' WHERE name = '{$uniqueName}' AND state = 'locked'"
                );
            return $update;
        }
        
    }
    
    
    /**
    * Once cron job has been updated in db it will
    * reset the job for the next time around.
    */
    public function __destruct() 
    {
        $reset = $this->book->exec(
                "UPDATE crons_lock SET state = 'locked' WHERE name = '{$this->uniqueName}' AND state = 'unlock'"
                );
        var_dump($reset);
        
                
    }
  
       
}