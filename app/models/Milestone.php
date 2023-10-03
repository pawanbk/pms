<?php 
namespace app\models;
use app\models\Task;
use core\Model;

class Milestone extends Model{
    protected $_table = 'milestones';
    
    public function getProgress($id){
        $task = new Task();
        
        $totalTasks= $task->where(['m_id'=>$id])->get();
        $total = $totalTasks->count();
        $completedTask = $task->where(['m_id'=>$id,'status'=>1])->get();
        $completed = $completedTask->count();
        return ($completed > 0 ) ? round(($completed/$total)*100,1) : 0;
    }
}