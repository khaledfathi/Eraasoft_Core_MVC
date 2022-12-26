<?php
namespace Eraasoft\Core\Databases;
use Eraasoft\Core\Contracts\Databases\DatabaseContract;
use Eraasoft\Core\Environment\Env;
use mysqli; 


class MySQL implements DatabaseContract {
    //connection
    private  object $conn; 
    private   string $sql ; 
    private  string $tableName;  
    //errors 
    public   array  $error = ['connection'=>'']; 

    public function __construct (){
        $this->connect(); 
    }

    public function __destruct (){
        $this->conn->close(); 
    }

    //open connection to database 
    private function connect() : void {
        $this->conn = new mysqli(
            Env::getEnv('DB_HOST'),
            Env::getEnv('DB_USER'),
            Env::getEnv('DB_PASSWORD'),
            Env::getEnv('DB_DATABASE'),
            Env::getEnv('DB_PORT')
        );
    }

    //return  current sql statment 
    public function getSQL():string  {
        return  $this->sql; 
    }

    //set table name , return this instance 
    public function table (string $table):object {
        $this->tableName = $table;  
        return $this;  
    }

     //execute 'insert' query , return count of affected rows 
    public function insert(array $data):int{
        $keys='' ; $values='';
        foreach ($data as $key=>$value){
           $keys .= $key. ' , '; 
           $values .= " '$value' , "; 
        }
        $this->sql= "INSERT INTO $this->tableName (".rtrim($keys , ', ').") values (".rtrim($values , ', ').")"; 
        return $this->exec();  
    }
 
    //set 'update' sql statment , return this instance
    public function update(array $data ):object {
        $row = "";
        foreach($data as $key => $value){
            $row .=  "`$key` = '$value' ,";
        }
        $row = rtrim($row,",");

        $this->sql = "UPDATE TABLE `$this->tableName` SET $row";
        return $this;
    }

    //set 'delete' sql statment , return this instance
    public function delete ():object{
        $this->sql= "DELETE FROM $this->tableName "; 
        return $this; 
    }

    //set 'select' sql statment , return this instance
    public function select (string $column) : object{
        $this->sql = "SELECT ".$column." FROM `".$this->tableName."` "; 
        return $this; 
    }

    //add 'where' to sql statment , return this instance
    public function where (string $column , string $operator , string $value): object{
        $this->sql .= "WHERE $column $operator '$value' ";
        return $this;  
    }
    
    //add 'and' to sql statment , return this instance
    public function andWhere (string $column , string $operator , string $value): object{
        $this->sql .= "and $column $operator '$value' ";
        return $this;  
    }

    //add 'or' to sql statment , return this instance
    public function orWhere (string $column , string $operator , string $value): object{
        $this->sql .= "or  $column $operator '$value' ";
        return $this;  
    }
    
    public function innerJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->sql .= "INNER JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    }

    public function leftJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->sql .= "RIGHT JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    } 

    public function rightJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->sql .= "RIGHT JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    } 

    //execute 'select' query , return all rows 
    public function all (): array{
       $result = $this->conn->query($this->sql);  
       return $result->fetch_all(); 
    }

      public function exec():int {
        $this->conn->query($this->sql);
        return $this->conn->affected_rows; 
    }

    //execute 'select' query , return first rows[assoc] 
    public function first(): array {
       $result = $this->conn->query($this->sql);  
       return $result->fetch_assoc(); 
    }

    //execute 'select' query , return last rows 
    public function last(): array {
       $result = $this->conn->query($this->sql)->fetch_all();  
       return end($result); 
    }
}
