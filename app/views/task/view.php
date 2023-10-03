<?php 
    use app\models\User;
    if(empty($tasks)):
?>
    <div class="card mx-auto" style="width:500px">
            <div class="card-body">
                <h5 class="card-title">Oops!</h5>
                <h6>No Task found for this Milestone</h6>
                <a href="/milestone/task/add">Add New Task</a>
            </div>
    </div>
    <?php else:?>
        
    <div class="table">
        <div class="card">
            <div class="card-header d-flex justify-content-around align-items-center">
                <button class="btn btn-sm btn-light text-dark" id="goBack">
                    <span class="material-icons">
                        arrow_back
                    </span>
                </button>
                All tasks
                <a href="/milestone/task/add" class="btn btn-info float-right">Add</a>
            </div>
            <div class="card-body">
        
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Due Date</th>
                            <th>Assignee</th>
                            <th>Mark As Complete</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tasks as $key=>$task):?>
                        <tr class="<?= cellColor($task->status,$task->due_date)?>">
                            <td><?= ++$key?></td>
                            <td><?= capital($task->name) ?></td>
                            <td class="due_date"><?= formatDate($task->due_date) ?></td>
                            <?php 
                                $user = new User();
                                $user = $user->findById($task->assignee)->results[0];
                            ?>
                            <td>
                                <select>
                                    <?php foreach((new User)->get()->all() as $user):?>
                                        <option value="<?= $user->user_id?>"><?= $user->f_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                            <td><input class="complete" data-id ="<?=$task->id ?>" type="checkbox" <?= ($task->status === 1 ) ? 'checked':''?>></td>
                            <td>
                                <a href="/task/<?= $task->id;?>/tasks"><i class="material-icons">&#xe8f4;</i></a>
                                <a href="/project/task/edit/<?= $task->id ?>"> <i class="material-icons">&#xE254;</i></a>
                                <a href="/project/task/delete/<?= $task->id ?>"><i class="material-icons" title="Delete">&#xE872;</i></a>
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



