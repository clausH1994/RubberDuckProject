<?php require_once "shop/cartsession.php" ?>
<?php include "header.php" ?>

<div id="shopping-cart">
<div class="heading">Shopping Cart <a class="waves-effect waves-light btn" id="emptyBtn" href="cart.php?action=empty">Empty Cart</a></div>
<?php
//Reset total cost to do recalc
var_dump($_SESSION['user_id']);
if(isset($_SESSION["cartItem"])){
	$total_price = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>Code</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price</strong></th>
<th><strong>Action</strong></th>
</tr>

<?php		
    foreach ($_SESSION["cartItem"] as $item){
		?>
				<tr>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><?php echo $item["code"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo $item["price"]." DKK"; ?></td>
				<td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="removeBtn">Remove</a></td>
				</tr>
				<?php
		$total_price += ($item["price"]*$item["quantity"]);
		
		}

		?>

<tr>
<td colspan="5" ><strong>Total:</strong> <?php echo $total_price." DKK"; ?> </td>
</tr>
</tbody>
</table>
  <?php
}
?>
<br>
<a class="waves-effect waves-light btn" id="checkout" href="checkout.php">checkout</a>