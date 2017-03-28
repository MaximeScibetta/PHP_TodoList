<header class="wrapper grid">
    <div id="branding" class=""><a href="index.php">Todolist</a></div>
            <div class="ta-right"><a href="index.php?r=auth&a=getLogout">Déconnexion</a></div>
    </header>
<div class="main-content wrapper">
    <h1>Vos prochaines tâches</h1>
<ol style="margin-top: 25px;padding-left: 0;">

    <?php
        if(isset($_SESSION['task'])){
            include('views/partials/_tasks.php');
        }else{
            echo '<li style="list-style: none; width: 500px;" class="alert alert-danger" role="alert">'.$_SESSION['errors']['task'].'</li>';
        }
    ?>

</ol><hr>
<h1>Ajouter une tâche</h1>

<form action="index.php"
      method="post" class="form-group row">
        <label for="description" class="textfield">
            <input type="text" name="description" id="description" size="80" class="form-control form-control-lg">
        <span >Description</span>
    </label>
    <input type="hidden"
           name="r"
           value="task">
    <input type="hidden"
           name="a"
           value="create">
    <button type="submit" class="btn btn-primary">Créer cette nouvelle tâche</button>
</form></div>
<footer class="wrapper">
    <p class="ta-right">Made by Dominique Vilain in 2016</p>
</footer>