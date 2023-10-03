
<div class="table vh-100">
    <div class="card">
        <div class="card-header d-flex justify-content-around align-items-center">
           My Projects
           <a href="project/add" class="btn btn-info float-right">Add</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Due date</th>
                        <th>Milestone</th>
                        <th>Average progress</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($projects as $key=>$project):?>
                    <tr>
                        <td><?= ++$key?></td>
                        <td><?= capital($project->name) ?></td>
                        <td class="due_date"><?= formatDate($project->date) ?></td>
                        <td><a class="view btn btn-info btn-sm" href="/project/<?= $project->proj_id;?>/milestones">view</a></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" style="width"></div>
                            </div>
                        </td>
                        <td>
                            <a href="/project/edit/<?= $project->proj_id ?>"> <i class="material-icons">&#xE254;</i></a>
                            <a href="/project/delete/<?= $project->proj_id ?>"><i class="material-icons" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr> 
                    <?php endforeach;?>	
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php displayMsg()?>

