<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
         render("buy_form.php", ["title" => "Sell"]);  
        
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (!preg_match("/^\d+$/",$_POST['quantity']))
           {
           apologize("Sale canceled. You can only buy whole shares, please indicate a positive integer");
           }
         
         if (lookup($_POST["symbol"])===false)
        
        {
            apologize("Sale canceled. Please choose a valid stock symbol"); 
        }
        
        
        $sharearray=lookup(strtoupper($_POST["symbol"]));
        $stock=strtoupper($_POST["symbol"]);
        $idrows=query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);    
        $saleprice=moneyformat($sharearray["price"]*$_POST["quantity"]);
        if ($saleprice>$idrows[0]['cash'])
        {
            apologize("Sale canceled.  Poor you! you don't have enough money to buy these shares of " . $_POST["symbol"]);
        }
         
        else
        {
            
            query("INSERT INTO portfolio (id, symbol, shares) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE shares = 
            shares + VALUES(shares)", $_SESSION["id"], "$stock", $_POST["quantity"]);
            
            $newbalance=$idrows[0]['cash']-$saleprice;
            query("UPDATE users SET cash = ? WHERE id = ?", $newbalance, $_SESSION["id"]);
            
            
            query("INSERT INTO history (id, symbol, soldorbought, number, price) VALUES (?, ?, 0, ?, ?)", $_SESSION["id"], 
            "$stock", $_POST["quantity"], $saleprice);  
            
            redirect("/");
        }
        
           
   }    

?>        
        
        
        
     
