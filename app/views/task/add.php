<?php 
    use core\Session;
    use app\models\Type;
    use app\models\User;
    $types = (new Type)->where(['user_id'=> Session::get('userId')])->get()->all();
    $users = (new User)->get()->all();
    $errors = $errors ?? [];
    $old = $old ?? [];
?>
<div class='box-wrapper mt-4'>
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-light text-dark" id="goBack">
                <span class="material-icons">
                    arrow_back
                </span>
            </button>
            Add Task
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/milestone/task/add">
                    <input type='hidden' name='m_id' value='<?= \core\Session::get('m_id')?>'/>
                    <div class='form-group'>
                        <label>Name</label>
                        
                        <input type='text' class='form-control <?= hasError('name',$errors) ? 'is-invalid' : ''?>' name='name' placeholder='Enter Name' value='<?= old('name',$old)?>'>
                        <div class='invalid-feedback'>
                            <?= error('name',$errors)?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>Due date</label>
                        <input type='date' class='form-control <?= hasError('due_date',$errors) ? 'is-invalid': '' ?>' name='due_date' placeholder='Enter Name' value='<?= old('due_date',$old)?>'>
                        <div class='invalid-feedback'>
                            <?= error('due_date',$errors)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="" class="form-control <?= hasError('due_date',$errors) ? 'is-invalid': ''?>">
                            <option value="">Select type    </option>
                            <?php foreach($types as $type):?>
                                <option value="<?=$type->id?>"><?=$type->name?></option>
                            <?php endforeach;?>
                        </select>
                        <div class='invalid-feedback'>
                            <?= error('type',$errors)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Priority Level</label>
                        <select name="type" id="" class="form-control">
                            <option value="">Select priority level</option>
                            <?php foreach($types as $type):?>
                            <option value="<?=$type->id?>"><?=$type->name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Assignee</label>
                        <select name="assignee" id="" class="form-control">
                        <?php foreach($users as $user):?>
                            <option value="<?= $user->user_id?>"><?=$user->f_name.' '.$user->l_name?></option>
                        <?php endforeach;?>
                        </select>
                    </div>

                    <div class='form-group'>
                        <button class='btn btn-info'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>