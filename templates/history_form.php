<style>
table.center 
{
    width:70%; 
    margin-left:15%; 
    margin-right:15%;
    line-height: 200%;
}
    
tr:first-child td 
{
    font-weight: bold;
} 
</style>        

 <table class="center" >
 
 <tr>
    <td> Stock symbol</td>
    <td> Time of transaction</td>
    <td> Type of transaction</td>
    <td> Number of shares</td>
    <td>  price of purchase </td>
 </tr>
 
 
 <?php foreach ($positions as $position): ?> 
 <tr>
    <td><?=$position["symbol"]?></td>
    <td><?=$position["time"]?> </td>
    <td><?=$position["purchase"]?> </td>
    <td><?=$position["number"]?> </td>
    <td>$<?=$position["price"]?> </td>
</tr>
 <?php endforeach ?>
 </table>
 
 
