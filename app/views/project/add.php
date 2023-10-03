<?php 
    $errors = $errors ?? [];
    $old = $old ?? [];
?>
<div class='box-wrapper mt-4'>
    <div class="card">
        <div class="card-header">
            Add Project
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/project/add">
                    <div class='form-group'>
                        <label>Name</label>
                        
                        <input type='text' class='form-control <?= hasError('name',$errors) ? 'is-invalid': '' ?>' name='name' placeholder='Enter Name' value='<?= old('name',$old)?>'>
                        <div class='invalid-feedback'>
                            <?= error('name',$errors)?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>Due date</label>
                        <input type='date' class='form-control <?= hasError('date',$errors) ? 'is-invalid' : '' ?>'
                             name='date'
                             placeholder='Enter Name' value='<?= old('date',$old)?>'>
                        <div class='invalid-feedback'>
                            <?= error('date',$errors)?>
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