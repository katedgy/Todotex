<?php 
 include_once("include/session.php");
    //session_start();  


?> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/log.css">
 
        <style type="text/css">
    body {
    background-image: url("images/bg.jpg");
    background-color: #cccccc;
}
</style>
<br /><br /><br /><br /><br /><br />
<div class="container">
<form action="process.php" method="post" class="form-signin">
<input type="hidden" size="1" readonly="yes" name="action" id="action" value="login">
    
    <h2 class="form-signin-heading text-center">Iniciar sesi&oacute;n</h2>
    <input id="user" class="form-control" placeholder="Nombre de usuario" required autofocus type="text" name="user" value="<?php echo $form->value("user"); ?>"/>
    <?php
        $erruser = $form->error("user");
        if($erruser!="")
        {
        echo '<span class="text-error-field">&nbsp;'.$erruser.'&nbsp;&nbsp;&nbsp;</span>';
        }
    ?>
    <input name="password" type="password" class="form-control" placeholder="Contrase&ntilde;a" value="<?php echo $form->value("password"); ?>">
    <?php
        $errpassword = $form->error("password");
        if($errpassword!="")
        {
        echo '<span class="text-error-field">&nbsp;'.$errpassword.'&nbsp;&nbsp;&nbsp;</span>';
        }
     ?>
    <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
</form> 
<div class="mastfoot">
            <div class="inner">
              <p>Sistema Administrativo de Todo Textil, C.A. Realizado por <a href="">Edgylin Rodriguez.</a>.</p>
            </div>
          </div>