<?php
namespace core;
use core\Controller;

class Database{

    public $conn, 
            $query,
            $results,
            $count=0,
            $where = '',
            $error=false;
    protected Controller $controller;

    public function __construct(){
        $this->controller = new Controller;
        try{
            $this->conn = new \PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USER'],$_ENV['DB_PASSWORD']);
        } catch(\PDOException $e){
            die($e->getMessage());
        }
    }

    public function query($sql,$params=[]){
        $this->error = false;
        if ($this->query = $this->conn->prepare($sql))
        {
            $x=1;
            if (count($params))
            {
                foreach($params as $param){
                    $this->query->bindValue($x,$param);
                    $x++;
                }
            }

            if ($this->query->execute())
            {
                $this->results=$this->query->fetchAll(\PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
            } else{
                $this->error = true;
            }
        }
        return $this;
    }

    public function error(){
        return $this->error ;
    }
    public function count(){
        return $this->count;
    }
    

}