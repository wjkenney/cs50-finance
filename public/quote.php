<?php

    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    
    {
        render("quote_form.php", ["title" => "quote"]);
        exit; 
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        if (lookup($_POST["symbol"])===false)
        
        {
            apologize("please choose a valid stock symbol"); 
        }
    
        else
        {
            $stock=lookup($_POST["symbol"]);
            
            $formatedprice=moneyformat($stock["price"]);
            
           render("price.php",["title"=>"price", "name"=>$stock["name"], "price"=>$formatedprice]);           
            
            
          
        }
    
   }
   ?>
    
      
        

