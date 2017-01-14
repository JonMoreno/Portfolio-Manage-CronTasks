/*****************************************
* SQLite version 3.15.2 
* Database Name: status.sqlite
* Path: /cron_manager/src/status.sqlite
*****************************************/


/************************
|   Table: crons_lock    |
************************/

CREATE TABLE crons_lock
(  
    name CHAR(25) PRIMARY KEY NOT NULL,
    state CHAR(25) NOT NULL,
    host  CHAR(25) NULL
);





