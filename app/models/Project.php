<?php 
namespace app\models;
use core\Model;

class Project extends Model{
    protected $key = 'proj_id';

    public function milestones(){
       return $this->hasMany(Milestone::class);
    }
}