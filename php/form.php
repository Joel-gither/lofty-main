<?php
if (null !==($_POST('go')))/
{
    $file = fopen("nem.dat". "&+");
    $user = str_replace("|", "", $_POST("username"));
    $pass = $_POST("password");
    $mail = $_POST("email");

    fputs($file, "\n" .$username.'|' .$password.'|' .$email.'/normal');
    fclose($file);

    echo "User registered";
}
 else
 {
    ?>
    reister user:<br />
    <form method="post">
    <input type="text" name="username"> User <br />
    <input type="password" name="password"> Password <br />
    <input type="text" name="email"> E-mail <br />
    <input type="submit" name="submit" value="send"/>
    </form>
    <?php
 }
    ?>


