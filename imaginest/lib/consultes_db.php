<?php

    function getCountUser($user)
    {
        require('connecta_db.php');
        try
        {
            $sql = "SELECT count(username) FROM users WHERE username = '$user' OR email = '$user'";
            $num = $db->query($sql);
            $resultat = $num->fetch();
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }

        return $resultat[0];
    }

    function insertUser($userPOST,$emailPOST,$fNamePOST,$lNamePOST,$passPOST)
    {
        require('connecta_db.php');

        try
        {
            $sql = "INSERT INTO users(email, username, passHash,userFirstName, userLastName, active) values ('$emailPOST','$userPOST','$passPOST','$fNamePOST','$lNamePOST',1)";
            $registre = $db->query($sql);
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }

        return $registre;
    }

    function getUserName($user)
    {
        require('connecta_db.php');

        try
        {
            $sql = "SELECT username FROM users WHERE email = '$user' OR username = '$user'";
            $userName = $db->query($sql);
            $resultat = $userName->fetch();
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }

        return $resultat[0];
    }

    function getCountActiveUser($user)
    {
        require('connecta_db.php');

        try
        {
            $sql = "SELECT count(username) FROM users WHERE (email = '$user' OR username = '$user') AND active = 1";
            $num = $db->query($sql);
            $resultat = $num->fetch();
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }

        return $resultat[0];
    }
    
    function isPasswordCorrect($user,$pass)
    {
        require('connecta_db.php');

        try
        {
            $sql = "SELECT passHash FROM users WHERE email = '$user' OR username = '$user'";
            $resultat = $db->query($sql);
            $passHash = $resultat->fetch();
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }

        return password_verify($pass,$passHash[0]);
    }

    function updateUser($user)
    {
        require('connecta_db.php');

        try
        {
            $sql = "UPDATE users SET lastSignIn = current_timestamp WHERE email = '$user' OR username = '$user'";
            $resultat = $db->query($sql);
        }
        catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
    }