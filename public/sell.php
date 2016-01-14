<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //go into the table and find out the stocks that are owned    
    
        //here we have an array each row as (the same "id", a different "symbol" and the number of "shares" for that symbol}
        $rows=query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    
        render("sell_form.php", ["title" => "Sell", "rows"=>$rows]);
   }
   else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rows=query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
        $sale=0;
    
    //first we loop through to validate Post request line. 
    foreach ($rows as $row)
    {
        $number=query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $row['symbol']);
        
        if (empty($_POST[$row['symbol']]))
           {
                continue;
           } 
        
        if (!preg_match("/^\d+$/",$_POST[$row['symbol']]))
           {
           apologize("Sale canceled. You can only sell whole shares of " . $row['symbol'] . ", please indicate a positive integer");
           }    
        if ($_POST[$row['symbol']]>$number[0]["shares"])
           {           
           apologize("Sale canceled. Poor you! You don't own enough shares of " . $row['symbol'] . " to sell");
           }
         
       
    } 
    
    //if validated we go through and make the purchase
    foreach ($rows as $row)
        { 
           
           $number=query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $row['symbol']);
        
           if (empty($_POST[$row['symbol']]))
           {
                continue;
           }
           
           if ($_POST[$row['symbol']]===$number[0]["shares"])
           {
              query("DELETE from portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $row['symbol']);
              $stock=lookup($row["symbol"]);
              $sale=moneyformat($stock[price]*$_POST[$row['symbol']]);    
              query("UPDATE users SET cash = cash+ ? WHERE id = ?", $sale, $_SESSION["id"]); 
             
              query("INSERT INTO history (id, symbol, soldorbought, number, price) VALUES (?, ?, 1, ?, ?)", $_SESSION["id"], 
              $row['symbol'], $_POST[$row['symbol']], $sale);   
           }
           
           
           
           else if ($_POST[$row['symbol']]<$number[0]["shares"])
           {
               $newshares = $number[0]["shares"]-$_POST[$row['symbol']];
               query("UPDATE portfolio SET shares = ? WHERE id = ? AND symbol = ?", $newshares, $_SESSION["id"], $row['symbol']);
               $stock=lookup($row["symbol"]);
               $sale=$stock["price"]*$_POST[$row['symbol']];
               query("UPDATE users SET cash = cash+ ? WHERE id = ?", $sale, $_SESSION["id"]);
               
               query("INSERT INTO history (id, symbol, soldorbought, number, price) VALUES (?, ?, 1, ?, ?)", $_SESSION["id"], 
               $row['symbol'], $_POST[$row['symbol']], $sale);
           }
           
           
        }
        redirect("/");
    }
 ?>

