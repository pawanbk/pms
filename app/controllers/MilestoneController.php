<?php
namespace app\controllers;
use core\Request;
use core\Session;
use core\Response;
use core\Validate;
use core\Controller;
use app\models\Project;
use app\models\Milestone;

class MilestoneController extends Controller{

    public function index(Request $request, Response $response,$id){
        Session::put('proj_id',$id);
        $project = (new Project)->findById($id);
        $milestones = $project->milestones();
        $this->render('milestone/view',['milestones'=>$milestones]);
    }
    public function add(){
        $this->render('milestone/add');
    }
    
    public function store(Request $request, Response $response){
        $validated = Validate::check($request->all(),[
            'name'=>[
                'required' => true,
                'min' => 3,
                'max' => 50
            ],
           
            'due_date' => [
                'required' => true,
                'latest' => true
            ]
        ]);

        if(!$validated){
            $response->set_status_code(400);
            return $this->render('milestone/add',['errors'=>Validate::errors(),'old'=>$request->all()]);
            exit;
        }

        $milestone = (new Milestone)->insert($request->only(['name','due_date','proj_id']));
        if(!$milestone){
            $response->set_status_code(500);
            return redirect("/project/".Session::get("proj_id")."/milestones");
        }

        $response->set_status_code(201);
        Session::flash('success','Milestone has been added');
        return redirect('/project/'.Session::get('proj_id').'/milestones');
    }

    
    public function delete(Response $response, $id){
        $milestone = (new Milestone)->findById($id);
        if($milestone){
            $milestone->delete();
            Session::flash('success','Milestone deleted');
            return redirect('/project/'.$id.'/milestones');
        }
    }

    public function edit($id){
        $milestone = (new Milestone)->findById($id);
        return $this->render('milestone/edit',['milestone'=>$milestone->first()]);
    }

    public function update(Request $request, Response $response){
        $milestone = (new Milestone)->findById($request->get('id'));
        $validated = Validate::check($request->all(),[
            'name'=>[
                'required' => true,
                'min' => 3,
                'max' => 50
            ],
           
            'due_date' => [
                'required' => true,
                'latest' => true
            ]
        ]);
        if(!$validated){
            $response->set_status_code(401);
            $this->render('/milestone/edit',[
                'errors'=>Validate::errors(),
                'milestone'=>$milestone->first()
            ]);
        }

        $update = $milestone->update(
           $request->only(['name','due_date'])
        );

        if($update){
            Session::flash("success","Project has been Updated");
            redirect('/project/'.Session::get('proj_id').'/milestones');
        }
    }
}