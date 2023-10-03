<?php 
    $errors = $errors ?? [];
?>
<div class='box-wrapper mt-4'>
    <div class="card">
        <div class="card-header">
            Add Task Type
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/task/type/edit">
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='hidden' name='id' value='<?=$type->id?>'>
                        <input type='text' class='form-control <?= hasError('name',$errors) ? 'is-invalid' : ''?>' name='name' placeholder='Enter Name' value='<?= $type->name?>'>
                        <div class='invalid-feedback'>
                            <?= error('name',$errors)?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <button class='btn btn-info'>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>