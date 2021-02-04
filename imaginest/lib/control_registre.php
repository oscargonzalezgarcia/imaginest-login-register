<?php

    include_once('consultes_db.php');

    function existeixUsuari($user)
    {   
        return (getCountUser($user)==1 ? true : false);
    }

    function validaEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) ? false : true);
    }

    function registrarUsuari($userPOST,$emailPOST,$fNamePOST,$lNamePOST,$passPOST)
    {
        return insertUser($userPOST,$emailPOST,$fNamePOST,$lNamePOST,$passPOST);
    }