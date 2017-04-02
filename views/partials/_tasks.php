
<?php foreach ( $data['tasks'] as $task ): ?>
    <li style="margin-bottom:25px; list-style:none;">
        <?php if( (isset($_GET['id'])) && ($task->taskId === $_GET['id']) ): ?>
            <?php include 'views/partials/_modifyTask.php'; ?>
        <?php else: ?>
        <div style="display: inline-block;">
            <form action="index.php" method="post">
                <label for="<?= $task->taskIsDone;?>" >
                    <input title="Changer le statut"
                           type="checkbox"
                           id="<?= $task->taskId;?>"
                           name="is_done"
                           value="<?= $task->taskIsDone;?>"
                        <?php if($task->taskIsDone === '1') : ?>
                            <?= 'checked'; ?>
                        <?php endif; ?>
                    >
                </label>
               <span  <?php if($task->taskIsDone) : echo 'style="text-decoration: line-through;"'; endif;?>>  <?= $task->taskDescription;?> </span>

                <button type="submit" class="btn btn-success" style="margin-left: 25px;">Enregistrer</button>
                <input type="hidden"
                       name="r"
                       value="task">
                <input type="hidden"
                       name="a"
                       value="postUpdate">
                <input type="hidden"
                       name="id"
                       value="<?= $task->taskId;?>">
            </form>
        </div>

        <div style="display: inline-block;">
            <form action="index.php" method="get">
                <button type="submit" class="btn btn-warning">modifier</button>
                <input type="hidden"
                       name="a"
                       value="getUpdate">
                <input type="hidden"
                       name="r"
                       value="task">
                <input type="hidden"
                       name="id"
                       value="<?= $task->taskId;?>">
            </form>
        </div>
        <div style="display: inline-block;">
            <form action="index.php" method="post">
                <button type="submit" class="btn btn-danger">supprimer</button>
                <input type="hidden"
                       name="a"
                       value="postDelete">
                <input type="hidden"
                       name="r"
                       value="task">
                <input type="hidden"
                       name="id"
                       value="<?= $task->taskId;?>">
            </form>
        </div>
        <?php endif; ?>
    </li>
<?php endforeach; ?>