<?php

include_once("config.php");

if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$tempPass = $_POST['password'];
		$password = password_hash($tempPass, PASSWORD_DEFAULT);
        $repassword = $_POST['confirm-password'];


		if(empty($name) || empty($surname) || empty($username) || empty($email) || empty($password) || empty($repassword))
		{
			echo "You need to fill all the fields.";
           
		}
		else
		{
            if($tempPass != $repassword) {
                echo "Password do not match !";
               
            }
			$sql = "SELECT username FROM users WHERE username=:username";

			$tempSQL = $conn->prepare($sql);
			$tempSQL->bindParam(':username', $username);
			$tempSQL->execute();

			if($tempSQL->rowCount() > 0)
			{
				echo "Username exists!";

			}
			else
			{
				$sql = "insert into users (name, surname, username, email, password) values (:name, :surname, :username, :email, :password)";
				$insertSql = $conn->prepare($sql);
			
				$insertSql->bindParam(':name', $name); 
				$insertSql->bindParam(':surname', $surname); 
				$insertSql->bindParam(':username', $username);
				$insertSql->bindParam(':email', $email);
				$insertSql->bindParam(':password', $password);

				$insertSql->execute();

				echo "Data saved successfully ...";
                
			}
		}
	}

?>