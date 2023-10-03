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
            Edit Milestone
        </div>
        <div class="card-body">
            <div class="form-box">
                <form method="post" action="/milestone/edit">
                    <input type="hidden" name="id" value="<?=$milestone->id?>">
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control <?= hasError('name',$errors) ? 'is-invalid' : ''?>' name='name' placeholder='Enter Name' value='<?= $milestone->name?>'>
                        <div class='invalid-feedback'>
                            <?= error('name',$errors)?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>Due date</label>
                        <input type='date' class='form-control <?= hasError('due_date',$errors) ? 'is-invalid': '' ?>' name='due_date' placeholder='Enter Name' value='<?= $milestone->due_date?>'>
                        <div class='invalid-feedback'>
                            <?= error('due_date',$errors)?>
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