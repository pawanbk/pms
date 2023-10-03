<?php
namespace app\controllers\Task;
use core\Request;
use core\Session;
use core\Response;
use core\Validate;
use app\models\Task;
use app\models\Type;
use app\models\User;
use core\Controller;

class MainController extends Controller{

    public function index(Request $request, Response $response,$id){
        Session::put('m_id',$id);
        $tasks = (new Task)->where(['m_id'=>$id])->get()->all();
        return $this->render('/task/view',[
            'tasks' => $tasks
        ]);
    }

    public function add(){
       
        return $this->render('task/add');
    }

    public function store(Request $request, Response $response){
        $validate = Validate::check($request->all(),[
            'name' => [
                'required' => true,
                'min' => 2,
            ],
            'due_date' => [
                'required' => true,
                'latest' => true
            ],
            'type' => [
                'required' => true
            ]
        ]);
        if(!$validate){
            return $this->render('task/add',[
                'errors' => Validate::errors(),
                'old' => $request->all()
            ]);
        }

        $task = (new Task)->insert([
            'name' => $request->get('name'),
            'due_date' => $request->get('due_date'),
            'type' => $request->get('type'),
            'created_by' => Session::get('userId'),
            'assignee' => $request->get('assignee'),
            'm_id' => Session::get('m_id')
        ]);
        if($task){
            Session::put('success','New task has been added');
            return redirect('/milestone/'.Session::get('m_id').'/tasks');
            
        }
    }

    public function markComplete(Request $request){
       $task = (new Task)->findById($request->get('id'));
       if($task){
           $status = $task->results[0]->status;
           $newStatus = $status === 1 ? 0 : 1;
           $task->update([
               'status' => $newStatus
           ]);
       }
    }
}