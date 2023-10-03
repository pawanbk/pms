<?php 
    $errors = $errors ?? [];
    $project = $project ?? [];
?>
<div class='box-wrapper mt-4'>
    <div class="card">
        <div class="card-header">
            Edit Project
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/project/edit">
                    <input type="hidden" name="proj_id" value="<?= $project->proj_id?>" >
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control <?= hasError('name',$errors) ? 'is-invalid': '' ?>' name='name' placeholder='Enter Name' value='<?= $project->name ?>'>
                        <div class='invalid-feedback'>
                            <?= error('name',$errors)?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>Due date</label>
                        <input type='date' class='form-control <?= hasError('date',$errors) ? 'is-invalid' : '' ?>'
                             name='date'
                             placeholder='Enter Name' value='<?= $project->date?>'>
                        <div class='invalid-feedback'>
                            <?= error('date',$errors)?>
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