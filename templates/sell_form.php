 <form action="sell.php" method="post">
    <fieldset>
    <div style="font-weight: bold">
    Please select the number of shares you would like to sell
    </div>
    <br/>
        <?php foreach ($rows as $row): ?> 
        <div class="form-group">                
            <input autofocus class="form-control" name="<?php echo $row['symbol'];?>" placeholder="<?php echo $row['symbol'];?>" type="text"/>
        </div>
        <?php endforeach ?>
        <div class="form-group">             
            <button type="submit" class="btn btn-default">submit</button>
        </div>    
    </fieldset>
 </form> 
    
