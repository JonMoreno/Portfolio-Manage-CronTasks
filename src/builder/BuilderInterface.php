<?php

namespace Cron\Builder;
  

interface BuilderInterface
{
/*
|-------------------------------------------------------------------------------
| Class: BuilderInterface                                                      
|-------------------------------------------------------------------------------
| Purpose: 
| Force implementation.
|
|
*/ 
    /**
    * Create cron job.
    */
    public function create();
    
    /**
    * Delete cron job.
    */
    public function destroy();
    
}