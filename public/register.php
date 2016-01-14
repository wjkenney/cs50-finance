<?php

// configuration
require("../includes/config.php");

require_once("libphp-phpmailer/class.phpmailer.php");

// if user reached page via GET (as by linking or redirect)

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
   render("register_form.php", ["title"=>"Register"]);
}

else if($_SERVER["REQUEST_METHOD"]== "POST") 
{
   // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("password and confimation must match");
        }
        
        else if (empty($_POST["email"]))
        {
            apologize("You must provide an email");  
        }
        
        $mail = new PHPMailer();
                     
        $mail -> isSMTP();
        $mail-> SMTPDebug = 2;

        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.gmail.com';

        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "cs50financeclichy@gmail.com";

        $mail->Password = "cs50finance";

        $mail->setFrom("cs50finance@gmail.com");

        $mail->addAddress($_POST['email']); 

        $mail->Subject = "Registration confirmation C$50finance";

        $mail->Body = "Thank you for registering with c$50finance, the world wide leader in accidently giving you free fake 
        cash and stock";

        if(!$mail->send())
        {
            apologize("Bad email");
        }
        
        // query database for user
        $query =query("INSERT INTO users (username, hash, cash, email) VALUES(?, ?, 10000.00, ?)", $_POST["username"],
        crypt($_POST["password"]), $_POST["email"]); 
               
        if ($query===(false)) 
          {
            apologize("this username has already been taken.");   
          }
       
           $rows = query("SELECT LAST_INSERT_ID() as id");
        
            $id = $rows[0]["id"];
        
            $_SESSION[ID] = ["id"]; 
        
            redirect("/");
        
     }

?>
