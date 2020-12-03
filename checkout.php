<?php require_once "shop/cartsession.php" ?>
<?php include "header.php" ?>

<?php $total_price=0 ?>

<div class="row" class="checkout">
    <form class="col s6">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" class="validate">
          <label for="addresse">addresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="postnr" type="text" class="validate">
          <label for="postnr">Post Nummer</label>
        </div>
        <div class="input-field col s8">
          <input id="by" type="text" class="validate">
          <label for="by">by</label>
        </div>
      </div>
      </div>
    </form>
  </div>
  <div class="row" class="checkout">
    <form class="col s6">
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
    </form>
    </div>
