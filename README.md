===Simple Cron Scheduling Across Identical Servers===


Arbitration Algorithm:

Using database as an arbiter.

Insert & Create Task:

-Step1 
    [Server A] INSERT new (task_name) and set 
    state to (unlocked) into the DB shared by all servers.
    
    Table:
    ____________________________
    |task_name | state  | host |
    |--------------------------|
    |uniqueName|unlocked| null |
    ----------------------------
    
    IF the (task_name) has been INSERTed by
    [Server A] and [Server B] tries to INSERT
    task_name it will NOT register again. 

-Step2
    [Server A] once task is INSERTed into DB create
    actual cron into machine.

    * * * * * [   command   ]

    If [Server B] could NOT INSERT (task_name) into 
    DB because it was INSERTed by [Server A]
    it WILL still create the cron into [Server B].

    
Run Tasks

-Step3
    a.[Server A] validate (task_name) was INSERTed and state (unlocked).
    b.[Server A] update (task_name) , state to (locked) and host[127.0.0.0] 
      when update happen db will create a reserved Lock.
    c.[Server A] will lock db during this process.
    
    Table:
    ____________________________
    |task_name | state  | host |
    |--------------------------|
    |uniqueName|unlocked| null |
    ----------------------------
    d.UPDATE state to (unlocked) in order for task to recur again.

    
    IF [Server B] tries to run the same (task_name) it will
    fail,database will be locked. 
    [Server B] will go back to sleep.
    
    

*** Mysql will be a better choice since it offers row 
    locking instead of locking the entire database.

    
    
