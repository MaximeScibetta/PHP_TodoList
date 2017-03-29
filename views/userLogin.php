<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Todolist</title>
    <link rel="stylesheet"
          href="./bower_components/cutestrap/dist/css/cutestrap.min.css">
    <link rel="stylesheet"
          href="./views/css/screen.css">
</head>
<body style="width: 500px; margin: 100px auto 0;">

<header class="wrapper grid">
    <div id="branding" class=""><a href="index.php">Todolist</a></div>
    </header>
<div class="container">
    <h1>Qui êtes-vous ?</h1>
    <form action="index.php"
          method="post">
        <fieldset>
            <legend style="margin: 0 0 50px 0;">Vos infos</legend>
            <div class="form-group row">
                <label for="email" class="textfield " >
                    <input type="text"
                           id="email"
                           name="email" class="form-control form-control-lg">
                    <span class="col-sm-1 col-form-label col-form-label-lg">Votre email</span>
                </label>
                <?php if((isset($_SESSION['errors']['email']))): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['errors']['email']; ?>
                    </div>
               <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="password" class="textfield">
                    <input type="password"
                           id="password"
                           name="password" class="form-control form-control-lg">
                    <span class="col-sm-2 col-form-label col-form-label-lg">Votre mot de passe</span>
                </label>
                <?php if((isset($_SESSION['errors']['password']))): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['errors']['password']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <input type="hidden"
                   name="a"
                   value="postLogin">
            <input type="hidden"
                   name="r"
                   value="auth">

            <div class="form-group row">
                <input type="submit"
                        value="vérifier"
                        class="btn btn-primary">
            </div>
        </fieldset>
    </form>
</div>
<footer class="wrapper">
    <p class="ta-right">Made by Dominique Vilain in 2016</p>
</footer>
</body>
</html>