<li style="margin-bottom:25px; list-style:none;">

        <form action="index.php" method="post">
            <label for="<?= $task->taskId;?>" class="checkbox">
                <input title="Changer le statut"
                       type="checkbox"
                       id="<?= $task->taskId;?>"
                       name="is_done"
                       value="<?= $task->taskIsDone;?>"
                    <?php if($task->taskIsDone === '1') : ?>
                        <?= 'checked'; ?>
                    <?php endif; ?>
                        >
                <span class="checkbox__label">
                    <?= $task->taskDescription;?>
                </span>
            </label>
            <label for="description" style="display: block;">
                <input type="text"
                       size="40"
                       value="<?= $task->taskDescription;?>"
                       name="description"
                       title="description"
                       id="description" class="form-control form-control-lg">
                <span class="textfield__label">Description</span>
            </label>
            <input type="hidden"
                   name="r"
                   value="task">
            <input type="hidden"
                   name="a"
                   value="postUpdate">
            <input type="hidden"
                   name="id"
                   value="<?= $task->taskId;?>">
            <br><button type="submit" class="btn btn-success">Enregistrer</button>
        </form>


        <form action="index.php" method="get">
            <button type="submit" class="btn btn-warning" style="margin: 15px 0;">modifier</button>
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


        <form action="index.php" method="post">
            <button type="submit" name="postDelete" class="btn btn-danger">supprimer</button>
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

 </li>