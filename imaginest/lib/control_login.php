<?php

    include_once('consultes_db.php');

    function verificaUsuari($user,$pass)
    {
        return isPasswordCorrect($user,$pass);
    }

    function existeixUsuariActiu($user)
    {   
        return (getCountActiveUser($user)==1 ? true : false);
    }

    function actualitzaLastLogin($user)
    {
        updateUser($user);        
    }

    function nomUsuari($user)
    {
        return getUserName($user);
    }