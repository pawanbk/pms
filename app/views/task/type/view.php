<?php 
    if(empty($types)):
?>
<div class="card mx-auto" style="width:500px">
        <div class="card-body">
            <h5 class="card-title">Oops!</h5>
            <h6>Sorry, No Task types found.</h6>
            <a href="/task/type/create">Create new types</a>
        </div>
</div>
<?php else:?>
<div class="table">
    <div class="card">
        <div class="card-header d-flex justify-content-around align-items-center">
            All Task Types
            <a href="/task/type/create" class="btn btn-info float-right">Add</a>
        </div>
        <div class="card-body">
    
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($types as $key=>$type):?>
                    <tr>
                        <td><?= ++$key?></td>
                        <td><?= capital($type->name) ?></td>
                        <td>
                            <a href="/task/type/edit/<?= $type->id ?>"> <i class="material-icons">&#xE254;</i></a>
                            <a href="/task/type/delete/<?= $type->id ?>"><i class="material-icons" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr> 
                    <?php endforeach;
                    endif;
                ?>	
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php displayMsg()?>

