<?php
namespace app\controllers;
use core\Controller;
use core\Request;
use core\Response;
use app\models\Project;
use core\Validate;
use core\Session;
use core\Auth;

class ProjectController extends Controller{

    public function index(){
        if(!Auth::isLoggedIn()){
            return $this->render('/auth/login');
        }

        $projects = (new Project)->where(['user_id'=>SESSION::get('userId')])->get();
        return $this->render('project/view',["projects"=>$projects->all()]);
    }

    public function add(){
        return $this->render('project/add');
    }

    public function store(Request $request, Response $response){
        $validated = Validate::check($request->all(),[
            'name'=>[
                'required' => true,
                'min' => 3,
                'max' => 50
            ],
           
            'date' => [
                'required' => true,
                'latest' => true
            ]
        ]);

        if(!$validated){
            return $this->render('project/add',['errors'=>Validate::errors(),'old'=>$request->all()]);
        }

        $project = (new Project)->insert([
            'name' => $request->get('name'),
            'date' => $request->get('date'),
            'user_id' => Session::get('userId')
        ]);
        if(!$project){
            $response->set_status_code(500);
            return redirect('/project/add');
        } 
        $response->set_status_code(201);
        Session::flash('success','New Project has been Added Successfully');
        return redirect('/');
    }

    
    public function delete($id){
        $project = (new Project)->findById($id);
        if($project){
            $milestone = new \app\models\Milestone;
            $milestone->where(['proj_id',$project->id])->delete();
            $project->delete();
            Session::flash('success','Project Deleted');
            return redirect('/');
        }
    }

    public function edit($id){
        $project = (new Project)->where(["proj_id",'=',$id])->get()->first();
        return $this->render('project/edit',['project'=>$project]);
    }

    public function update(Request $request, Response $response){
        $project = (new Project)->findById($request->get('proj_id'));
        $validated = Validate::check($request->all(),[
            'name'=>[
                'required' => true,
                'min' => 3,
                'max' => 50
            ],
           
            'date' => [
                'required' => true,
                'latest' => true
            ]
        ]);
        if(!$validated){
            $response->set_status_code(401);
            $this->render('project/edit',['errors'=>Validate::errors(),'project' => $project->first()]);
            exit;
        }

        $update = $project->update(
           $request->only(['name','date'])
        );

        if($update){
            Session::flash("success","Project has been Updated");
            return redirect('/');
        }
    }
}