 <div style="font-weight: bold"> Welcome <?=$name?> </div>
 <table class="table table-striped">     
    <thead>
     <tr style="font-weight: bold">
        <td > symbol </td>
        <td> number of shares  </td>
        <td> price per share  </td>
        <td> total price </td>
    </tr>
   </thead>
 <tbody>
<?php foreach ($positions as $position): ?>
    <tr>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td>$<?= $position["price"] ?></td>
        <td>$<?= $position["sprice"] ?> </td>
    </tr>
    <?php endforeach ?>
 </tbody>
</table>
    <br/>
    <br/>
    <br/>
    
 <div style="font-weight: bold"> Total cash balance  </div>
 <div> $<?= htmlspecialchars($cash) ?> </div>
<div style="font-weight: bold"> Total value of Stocks  </div>
 <div> $<?= htmlspecialchars($totalassetprice) ?> </div> 
 <div style="font-weight: bold"> Total Portfolio Value  </div>
 <div> $<?= htmlspecialchars($totalportfolio) ?> </div>
 <div>
    <a href="logout.php">Log Out</a>
</div>
