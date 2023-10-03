<?php
namespace app\controllers\Task;

use core\Request;
use core\Session;
use core\Response;
use core\Validate;
use app\models\Type;
use core\Controller;

class TypeController extends Controller{

    public function index(){
        $types = (new Type)->where(['user_id'=>Session::get('userId')])->get()->all();
        return $this->render('/task/type/view',[
            'types' => $types
        ]);
    }

    public function add(){
        return $this->render('/task/type/create');
    }

    public function store(Request $request, Response $response){
        $validate = Validate::check($request->all(),[
            'name'=>[
                'required' => true,
                'min' => 2
            ]
        ]);

        if(!$validate){
            return $this->render('/task/type/create',['errors'=>Validate::errors()]);
            exit;
        }

        $type = (new Type)->insert([
            'name' => $request->get('name'),
            'user_id' => Session::get('userId')
        ]);

        if($type){
            Session::put('success','Task has been added');
            return redirect('/task/types');
        }
    }
    
    public function edit($id){
        $type = (new Type)->findById($id);
        return $this->render('/task/type/edit',[
            'type' => $type->first()
        ]);
    }

    public function update(Request $request, Response $response){
        $type = (new Type)->findById($request->get('id'));
        $validate = Validate::check($request->all(),[
            'name' =>[
                'required' => true,
                'min' => 2
            ]
        ]);
        if(!$validate){
            return $this->render('/task/type/edit',[
                'errors' => Validate::errors(),
                'type' => $type->first()
            ]);
        }

        $update = $type->update([
            'name' => $request->get('name')
        ]);

        if($update){
            Session::put('success','Updated');
            redirect('/task/types');
        }

    }

    public function delete(Response $response,$id){
        $type = (new Type)->findById($id);
        $delete = $type->delete();

        if($delete){
            Session::put('success','Successfully! Deleted');
            redirect('/task/types');
        }
        
    }
}