<?php 
  require_once "connection/dbcon.php";
  require_once "connection/Redirector.php";
  $total_price=0; 

  require_once "header.php";

if (isset($_SESSION['user_id'])) {
    $customerID = htmlspecialchars($_SESSION['user_id']);
    $dbCon = dbCon();
    $query = $dbCon->prepare("SELECT * FROM Customer, PostalCode WHERE CustomerID=$customerID AND PostalCode.zipcodeID=Customer.postalID");
    $query->execute();
    $getCustomer = $query->fetchAll();

    
    ?>
<div class="row" class="checkout">
    <form class="col s6" method="post" action="shop/checkfunc.php">
    <div class="row">
        <div class="input-field col s12">
          <input type="text" value="<?php echo $getCustomer[0]['email']; ?>" class="validate">
          <label for="email">E-mail</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" value="<?php echo $getCustomer[0]['fname']; ?>" type="text" class="validate">
          <label for="first_name">Fornavn</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" value="<?php echo $getCustomer[0]['lname']; ?>" type="text" class="validate">
          <label for="last_name">Efternavn</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="<?php echo $getCustomer[0]['phonenumber']; ?>" class="validate">
          <label for="adresse">Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="<?php echo $getCustomer[0]['address']; ?>" class="validate">
          <label for="adresse">Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="postnr" type="text" value="<?php echo $getCustomer[0]['postalID']; ?>"  class="validate">
          <label for="postnr">Post Nummer</label>
        </div>
        <div class="input-field col s8">
          <input id="by" type="text" value="<?php echo $getCustomer[0]['City']; ?>" class="validate">
          <label for="by">By</label>
        </div>
      </div>
      </div>      
      <button class="btn waves-effect waves-light" type="submit" name="submit">Køb</button>
    </form>
    <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
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
                        <td><a href="checkout.php?action=remove&code=<?php echo $item["code"]; ?>" class="removeBtn">Remove</a></td>
                        </tr>
                        <?php
                $total_price += ($item["price"]*$item["quantity"]);
                
                }?>
        <tr>
        <td colspan="5" ><strong>Total:</strong> <?php echo $total_price." DKK"; ?> </td>
        </tr>
        </tbody>
        </table>
    </form>
    </div>
    </html>
    <?php } 
  else {
    $redirect = new Redirector('Customer/customerLoginView.php');
   } ?>