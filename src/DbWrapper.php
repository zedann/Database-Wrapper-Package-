<?php
namespace Zedan\DatabasePackage;

class DbWrapper 
{
    public $connection;
    public string $query;
    public function __construct($SERVER,$USER,$PASS,$DBNAME,$PORT = 3306)
    {
        $this->connection = mysqli_connect($SERVER,$USER,$PASS,$DBNAME,$PORT);
    }
    

    public function select($table,$cols){
       $this->query = "SELECT $cols FROM $table";
       return $this;
    }
    public function where($col , $compare , $value){
        $this->query = $this->query . " WHERE {$col} {$compare} '{$value}'";
        return $this;
    }
    public function andWhere($col , $compare , $value){
        $this->query = $this->query . " AND {$col} {$compare} '{$value}'";
        return $this;
    }
    public function orWhere($col , $compare , $value){
        $this->query = $this->query . " OR {$col} {$compare} '{$value}'";
        return $this;
    }
    public function getAll(){
        $sqlData = mysqli_query($this->connection,$this->query);
        while($row = mysqli_fetch_assoc($sqlData)){
            $data[] = $row;
        }
        return $data;
    }
    public function getRow(){
        $row = mysqli_query($this->connection,$this->query);
        return mysqli_fetch_assoc($row);
    }
    //insert
    public function insert($table,$data){
        $columns = "";
        $values = "";
        foreach($data as $key=>$value){
            $columns .= "{$key},";
            $values .= "'{$value}',";
        }
        $columns = trim($columns,",");
        $values = trim($values,",");
        $this->query = "INSERT INTO {$table} ($columns)VALUES($values)";
        // echo $this->query;die;
        return $this;
     }
     public function execute(){
        mysqli_query($this->connection,$this->query);
        if(mysqli_affected_rows($this->connection)>0){
            return true;
        }else {
            return false;
        }
     }
}