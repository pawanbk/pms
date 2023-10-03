<?php 
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
            Add Milestone
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/project/milestone/add">
                    <input type='hidden' name='proj_id' value='<?= \core\Session::get('proj_id')?>'/>
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
                    <div class='form-group'>
                        <button class='btn btn-info'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>