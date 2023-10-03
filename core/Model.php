<?php
namespace core;
use core\Database;


class Model extends Database{
    public $id = null;
    protected $params = [];

    public const SQL_SELECT = "SELECT * FROM";
    public const SQL_DELETE = "DELETE FROM";
    public const SQL_INSERT = "INSERT INTO";
    public const SQL_UPDATE= "UPDATE ";

    public function __construct(){
        parent::__construct();
        if(!property_exists($this, 'table')){
            $this->table = strtolower(explode('\\',$this::class)[2].'s');
        }
        if(!property_exists($this, 'key')){
            $this->key = 'id';
        }
    }

    public function where($where=[]){
        $this->where = "WHERE";
        $count = count($where);
        if(isAssoc($where)){
            switch($count){
                case 1:
                    foreach($where as $key=>$value){
                        $this->where .= sprintf(" %s =%s",$key,'?');
                        $this->params[$key] = $value;   
                    }
                break;
    
                case 2:
                    $x = 1;
                    foreach($where as $key => $value){
                        $this->where .= sprintf(" %s=%s",$key,'?');
                        $this->params[$key] = $value; 
                        if($x<$count){
                            $this->where .= " AND";
                        }
                        $x++;
                    }
                break;
            }
        } else{
            switch($count){
                case 2:
                        $this->where .= " $where[0] = ?";
                        $this->params[$where[0]] = $where[1];
                break;
                case 3:
                    $field = $where[0];
                    $operator = $where[1];
                    $value = $where[2];
                    $this->where .= " $field $operator ?";
                    $this->params[$where[0]] = $value;
                    break;
            }
        }
        
        return $this;
    }

    public function get(){
        return $this->query(self::SQL_SELECT." $this->table $this->where", $this->params);
    }
    
    public function all(){
        return $this->results;
    }

    public function first(){
        return count($this->results) > 0 ? $this->results[0]: '';
        // return $this;
    }

    public function findById($id){
        $this->where([$this->key => $id]);
        $data = $this->get();
        if(empty($this->results)){
            return $this->controller->render('404');
        }
        $this->setId($data->results[0]->{$this->key});
        return $data;
    }
    
    public function delete()
    {   
        if(!$this->where){
            $this->where([$this->key=>$this->id]);
        }
        return $this->query(self::SQL_DELETE." ".$this->table." ".$this->where,$this->params);
    }

    public function update ($fields=array()){
        $set = '';
        $x = 1;
        foreach ($fields as $name => $value){
            $set .= "{$name} = ? ";
            if ($x < count($fields))
            {
                $set .=', ';
            }
            $x++;
        }

        if($this->where == ""){
            $this->where([$this->key=>$this->id]);
        } 

        $sql = self::SQL_UPDATE."{$this->table} SET {$set}$this->where";
        foreach($this->params as $param){
            $fields[] = $param;
        }
        
        if (!$this->query($sql, $fields))
        {
            return false;
        }

        return true;

    }

    public function insert($fields=array())
    {
        if (count($fields))
        {
            $keys = array_keys($fields);
            $values = '';
            $x=1;
            foreach ($fields as $field){
                $values .= '?';

                if ($x < count($fields)){
                    $values .= ',';

                }
                $x++;
            }

            $sql= self::SQL_INSERT." {$this->table} (`" . implode('`,`',$keys). "`) VALUES ({$values})";

            if (!$this->query($sql,$fields)){
                return false;
            }
        }
        return true;
    }

    private function setId($value){
        $this->id = $value;
    }

    protected function hasMany($class){
        $table = strtolower(explode('\\',$class)[2].'s');
        $this->where([$this->key => $this->id]);
        $this->query("SELECT * FROM $table $this->where", $this->params);
       return $this->results;
    }
}