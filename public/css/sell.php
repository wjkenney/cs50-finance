<?php

    // configuration
    require("../includes/config.php"); 

    //go into the table and find out the stocks that are owned    
    
    //here we have an array each row as (the same "id", a different "symbol" and the number of "shares" for that symbol}
    $rows=query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    
    render("sell_form.php", ["title" => "Sell", "rows"=>$rows]);
