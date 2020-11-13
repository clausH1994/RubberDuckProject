<?php
include "connection/session.php" ?>

<?php include "header.php" ?>

<div id="shopping-cart">
<div class="heading">Shopping Cart <a id="emptyBtn" href="cart.php?action=empty">Empty Cart</a></div>
<?php
//Reset total cost to do recalc
if(isset($_SESSION["cartItem"])){
    $total_price = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>ID</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price</strong></th>
<th><strong>Action</strong></th>
</tr>

<?php	
	$total_items = 0;	
    foreach ($_SESSION["cartItem"] as $item){
		?>
				<tr>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><?php echo $item["productID"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo $item["price"]." DKK"; ?></td>
				<td><a href="cart.php?action=remove&productID=<?php echo $item["productID"]; ?>" class="removeBtn">Remove</a></td>
				</tr>
				<?php
		$total_price += ($item["price"]*$item["quantity"]);
		
		}

		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo $total_price." DKK"; ?> </td>
</tr>
</tbody>
</table>
  <?php
}
?>