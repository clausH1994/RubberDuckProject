<?php require_once "header.php" ?>

<?php require_once("connection/dbcon.php");
$dbcon = dbCon();

?>

<div id="shopping-cart">
	<div class="heading">Shopping Cart <a class="waves-effect waves-light btn" id="emptyBtn" href="cart.php?action=empty">Empty Cart</a></div>
	<?php
	//Reset total cost to do recalc
	if (isset($_SESSION["cartItem"])) {
		$total_price = 0;

		$recommendedColor = 0;
		$recommendedColor2 = 0;
		$cartItem = $_SESSION["cartItem"];
		$amountOfproducts = count($cartItem);
		$amountOfproductsMinustwo = $amountOfproducts - 2;
		$x = 0;
		$rand = rand(0, $amountOfproductsMinustwo);
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
				foreach ($_SESSION["cartItem"] as $item) {
				?>
					<tr>
						<td><strong><?php echo $item["name"]; ?></strong></td>
						<td><?php echo $item["code"]; ?></td>
						<td><?php echo $item["quantity"]; ?></td>
						<td><?php echo $item["price"] . " DKK"; ?></td>
						<td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="removeBtn">Remove</a></td>
					</tr>
				<?php

					$total_price += ($item["price"] * $item["quantity"]);
					if ($x == $amountOfproducts - 1) {
						$recommendedColor = $item["color"];
					}
					if ($x == $rand) {
						$recommendedColor2 = $item["color"];
					}
					$x++;
				}

				?>

				<tr>
					<td colspan="5"><strong>Total:</strong> <?php echo $total_price . " DKK"; ?> </td>
				</tr>
			</tbody>
		</table>
		<br>
		<a class="waves-effect waves-light btn" id="checkout" href="checkout.php">checkout</a>
		<br>
		<div class="row">
			<h4>Recommended products</h4>
			<?php
			$i = 0;
			$j = 0;
			$query = "SELECT * FROM Product p WHERE color = $recommendedColor ORDER BY RAND()";
			$handle	= $dbcon->prepare($query);
			$handle->execute();
			$product_array = $handle->fetchAll();

			$query2 = "SELECT * FROM Product p WHERE color = $recommendedColor2 ORDER BY RAND()";
			$handle2 = $dbcon->prepare($query2);
			$handle2->execute();
			$product_color = $handle2->fetchAll();
			if (!empty($product_array || $product_color)) {
				if (!empty($product_array)) {



					foreach ($product_array as $aNumber => $value) {
						if ($i <=	 1) {
							$colorID = $product_array[$aNumber]["color"];
							$colorQuery = "SELECT * FROM Color WHERE colorID = $colorID limit 1";
							$handleColor = $dbcon->prepare($colorQuery);
							$handleColor->execute();
							$color = $handleColor->fetchAll();

			?>
							<form method="post" action="index.php?action=add&code=<?php echo $product_array[$aNumber]["code"]; ?>">
								<div class="col s12 m3">
									<div class="card">
										<span class="card-title"><?php echo $product_array[$aNumber]["name"]; ?></span>
										<div class="card-image">
											<img src="<?php echo $product_array[$aNumber]["image"]; ?>" id="image">
										</div>
										<div class="card-content">
											<p><?php echo $product_array[$aNumber]["desc"]; ?></p>
										</div>
										<div>
											<p> Color: <?php echo $color[0]['name']; ?></p>
										</div>
										<div>
											<p>Price: <?php echo $product_array[$aNumber]["price"]; ?> DKK</p>
										</div>
										<div>
											<label for="quantity">quantity:</label>
											<input type="text" name="quantity" value="1" size="1" />
											<button class="waves-effect waves-light btn" type="submit">Add to cart</button>
										</div>
									</div>
								</div>
							</form>
						<?php
							$i++;
						}
					}
				}

				if (!empty($product_color)) {

					foreach ($product_color as $aNumber => $value) {
						if ($j <= 1) {
							$colorID = $product_color[$aNumber]["color"];
							$colorQuery = "SELECT * FROM Color WHERE colorID = $colorID limit 1";
							$handleColor = $dbcon->prepare($colorQuery);
							$handleColor->execute();
							$color = $handleColor->fetchAll();

						?>
							<form method="post" action="index.php?action=add&code=<?php echo $product_color[$aNumber]["code"]; ?>">
								<div class="col s12 m3">
									<div class="card">
										<span class="card-title"><?php echo $product_color[$aNumber]["name"]; ?></span>
										<div class="card-image">
											<img src="<?php echo $product_color[$aNumber]["image"]; ?>" id="image">
										</div>
										<div class="card-content">
											<p><?php echo $product_color[$aNumber]["desc"]; ?></p>
										</div>
										<div>
											<p> Color: <?php echo $color[0]['name']; ?></p>
										</div>
										<div>
											<p>Price: <?php echo $product_color[$aNumber]["price"]; ?> DKK</p>
										</div>
										<div>
											<label for="quantity">quantity:</label>
											<input type="text" name="quantity" value="1" size="1" />
											<button class="waves-effect waves-light btn" type="submit">Add to cart</button>
										</div>
									</div>
								</div>
							</form>
			<?php
							$j++;
						}
					}
				}
			}
			?>
		</div>
	<?php
	}
	?>