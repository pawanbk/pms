<?php 
    use app\models\Milestone;
    if(empty($milestones)):
?>
    <div class="card mx-auto" style="width:500px">
            <div class="card-body">
                <h5 class="card-title">Oops!</h5>
                <h6>No Milestone found for this Project</h6>
                <a href="/project/milestone/add">Add New Milestone</a>
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
               Milestones
                <a href="/project/milestone/add" class="btn btn-info float-right">Add</a>
            </div>
            <div class="card-body">
        
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Due Date</th>
                            <th>Tasks</th>
                            <th>Progress Bar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($milestones as $key=>$milestone):?>
                        <tr>
                            <td><?= ++$key?></td>
                            <td><?= capital($milestone->name) ?></td>
                            <td class="due_date"><?= formatDate($milestone->due_date) ?></td>
                            <td><a class="view btn btn-info btn-sm" href="/milestone/<?= $milestone->id;?>/tasks">view</a></td>
                            <td>
                                <div class="progress">
                                    <?php $m = new Milestone; ?>
                                    <div class="progress-bar progress-bar-striped" style="width:<?= $m->getProgress($milestone->id).'%'; ?>">
                                        <?= $m->getProgress($milestone->id).'%';?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="/milestone/edit/<?= $milestone->id ?>"> <i class="material-icons">&#xE254;</i></a>
                                <a href="/project/milestone/delete/<?= $milestone->id ?>"><i class="material-icons" title="Delete">&#xE872;</i></a>
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

