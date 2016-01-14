<?php

    // configuration
    require("../includes/config.php"); 

    //go into the table and find out the stocks that are owned    
    
    //here we have an array each row as (the same "id", a different "symbol" and the number of "shares" for that symbol}
    $rows=query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    
    $positions=[];
    foreach ($rows as $row) //taking each row at a time.  
    {
        $stock=lookup($row["symbol"]);
        if ($stock !==false)
        {
            $positions[]= [
                "name"=>$stock["name"], 
                "price"=>moneyformat($stock["price"]),
                "shares"=>$row["shares"],
                "symbol"=>$row["symbol"],
                 "sprice"=>moneyformat($stock["price"]*$row["shares"])
            ];
        }
    }

    
    $totalassetprice = array_sum(array_column($positions,'sprice'));
    //totalassetprice gives the correct result
    
    $newrows=query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $nrow = $newrows[0];  
    $totalportfolio = $totalassetprice+$nrow["cash"]; 
   
    render("portfolio.php", [
        "title" => "portfolio", 
        "positions"=>$positions, 
        "cash" =>$nrow["cash"],
        "name"=>$nrow["username"], 
        "totalassetprice"=>$totalassetprice,
        "totalportfolio" =>$totalportfolio]);  

?>
