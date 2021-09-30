<?php
session_start();
$_SESSION['user'] = (!$_SESSION) ? 0 : $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Security</title>
          </head>
            <body>
                <h1>Index</h1>
                <br>
                <form class="form-reg" method="POST" name="Registr" action="auth.php">
                  <input class="form-reg__input" type="submit" value="Registr">
                </form>
                <br>
                <form class="form-autoris" method="POST" name="Autorising" action="Autorising.php">
                  <input class="form-autoris__input" type="submit" value="Autorising">
                </form>
                <br>
                <form class="form-off" method="post" action="a_off.php">
                  <input class="form-off__input" type="submit" value="Autorising OFF">
                </form>
                <br>
                <?php
                  if($_SESSION['user'] == 0 || !$_SESSION){
                    echo "<button disabled> Доступ к закрытой странице </button>";
                  }
                  else{
                    echo '<form class="form-butt" method="post" action="close.php">
                    <input class="form-butt__input" type="submit" value="Доступ к закрытой странице">
                    </form>';
                  }
                ?>
            </body>
</html>
