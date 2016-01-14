<?php

    // configuration
    require("../includes/config.php");
    $historyrows=query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    settype($purchasetype, "string");
    foreach($historyrows as $row)
    {
    if ($row["soldorbought"] ==1) 
               {
               
               $purchasetype = 'sale';  
               }
       else if ($row["soldorbought"] ==0)
               {
               $purchasetype = 'purchase';
               }
               
        
        $positions[]=[
            "symbol"=>$row["symbol"],
            "time"=>$row["time"],
            "purchase"=>$purchasetype,
            "number"=>$row["number"],
            "price"=>$row["price"]];       
     }
     
    $userrows=query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    render("history_form.php", ["title" => "History", "positions"=>$positions, "userrows"=>$userrows]);
    
