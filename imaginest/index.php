<?php

    require_once("./lib/control_login.php");
       
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['user']) && isset($_POST['pwd']))
        {
            $userPOST = filter_input(INPUT_POST, 'user');
            $passPOST = filter_input(INPUT_POST, 'pwd');

            if(existeixUsuariActiu($userPOST))
            {
                $usuari = verificaUsuari($userPOST,$passPOST);
                if($usuari){
                    session_start();
                    $_SESSION['usuari'] = nomUsuari($userPOST);
                    actualitzaLastLogin($userPOST);
                    header("Location: home.php");
                    exit;
                }
                else $errUser = TRUE;
            }
            else $errUser = TRUE;     
        }      
    }
    else
    {
        if(isset($_COOKIE[session_name()]))
        {
            header("Location: home.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <title>ImagiNest</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./css/estils.css" />
        <link rel="icon" href="./img/icon.jpg" />
    </head>
    <body>
        <div class="cont">
            <div class="form">
                <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <h1>ImagiNest</h1>
                    <input id="user" type="text" class="user" name="user" placeholder="Username/Email" required/>
                    <input id="pwd" type="password" class="pass" name="pwd" placeholder="Password" required/>
                    <?php 
                        if(isset($_COOKIE["success"])) 
                        {
                            echo $_COOKIE["success"]; 
                            setcookie("success","",time()-3600);
                        }
                        elseif(isset($errUser) && $errUser==TRUE) echo "<p class='alert alert-danger'>Could not login with these credentials!</p>";   
                    ?>
                    <input class="login" type="submit" value="Sign in"/>
                    <div class="register">
                        <p>Don’t have an account yet?</p>
                        <a href="register.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>