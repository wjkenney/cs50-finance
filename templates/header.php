<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css?<?php echo time(); ?>" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>


    </head>

    <body>

        
        <div class="container">
        
            <div id="top">
                <a href="/"><img alt="C$50 Finance" src="/img/logo.gif"/></a>
            </div>
           <br/>
         <ul class="nav nav-pills"> 
            <li> <a href="sell.php">sell</a> </li>
            <li> <a href="buy.php">buy</a> </li>
            <li> <a href="history.php">history</a> </li>
            <li> <a href="quote.php">query</a> </li>
        </ul> 

            <div id="middle">
