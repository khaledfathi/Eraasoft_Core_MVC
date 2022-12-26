<?php
require ('vendor/autoload.php');

use Eraasoft\Core\Databases\MySQL;
use Eraasoft\Core\Sessions\Sessions;
use Eraasoft\Core\Validation\Validation;

/*
* config is live in /config.json
* first namespace for managing databases [using object methods] 
* seecond namespace handle sessions and cookies [using static methods ] 
* third namespace validate (text fields , passwords , emails) [using static methods]
*/

echo "<pre>";

/****
Test Database = Pass OK.
Note : change your database configuration at /config.json line 3~7
*/

//$db = new MySQL;
//print_r($db->table('users')->select('*')->all()); 


/****
Test Sessions = Pass OK
Choose between sessions type [session or cookie] at /config.json Line 11
*/
   
//Sessions::Set('testKey' , 'testValue'); 
//Sessions::Set('testKey1' , 'testValue1'); 
//Sessions::Set('testKey2' , 'testValue2'); 
//Sessions::Destroy('testKey'); 
//Sessions::Destroy(); //with no paramet , it'll destroy all sessions  
//print_r($_SESSION); 

/****
Test Validation = Pass OK 
Set Criterias for Validate [text_fields or emails or passwords] at /config.json at Linei 14~18 
*/

//echo (Validation::TextField('khaled')) ? 'Valid' : 'Invalid'; 
//echo (Validation::Email('khaled@mail.com')) ? 'Valid' : 'Invalid'; 
//echo (Validation::Password('asd@12345')) ? 'Valid' : 'Invalid'; 