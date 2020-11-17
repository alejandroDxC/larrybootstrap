<?php

$page_title = 'calculator';

 include 'header.php';

   if (isset($_POST['submitted'])) {

    if (is_numeric($_POST['quantity'])  && is_numeric($_POST['price']) && is_numeric($_POST['tax'])
       && is_numeric($_POST['discount']) && is_numeric($_POST['payments'])){

         $price = $_POST['price'];
         $quantity = $_POST['quantity'];
         $discount = $_POST['discount'];
         $tax = $_POST['tax'];
         $shipping = $_POST['shipping'];
         $payments = $_POST['payments'];

          // Calculate the total:
             $total =(($price * $quantity)+ $shipping) - $discount;
          
              // Determine the tax rate:
                 $taxrate = ($tax/100) + 1;
                 $taxrate++;
             // Factor in the tax rate:
                 $total = $total * $taxrate;

            // Calculate the monthly payments:
                 $monthly = $total / $payments;


          print "<div class='span12 columns'>
                  <div class='alert-message block-message success'>   
                  <a class= 'close' href='#' >X </a>
                      <p><strong>You have selected to purchase:</strong><br />
                         <span class=\"number\">$quantity </span> widget(s) at <br />
                               $<span class=\"number\">$price</span> price each plus a <br />
                               $<span class=\"number\">$shipping</span> shipping cost and a <br />
                                <span class=\"number\">$tax</span>percent tax rate.<br />
                     After your $<span class=\"number\">$discount</span> discount, the total cost is $<span class=\"number\">".number_format($total,2)."</span>.<br />
                     Divided over <span class=\"number\">$payments</span> monthly payments,that would be $<span class=\"number\">".number_format($monthly,2)."</span> each. 1</p>"
                  . "</div></div>";
          

 } else {

   echo ' <div class="span12 columns">
               <div class="alert-message error">
                    <a class= "close" href="#">X</a>
               <p> Please enter a valid quantity, price, and   tax. </p>         
         </div>

</div>';

 }

}
?>

<center>

<h2>Widget Cost Calculator</h2>

 <form action="Calculator.php" method="post" class='form-stacked'>

  <p>Quantity: <input placeholder="Quantity" name="quantity" maxlength="10" value="<?php
  if(isset($_POST['quantity'])){ echo $_POST['quantity'];}?>" /></p>

  <p>Price: <input placeholder="Price" name="price" maxlength="10" value="<?php
  if(isset($_POST['price'])){echo $_POST['price'];}?>"/></p>
  
  <p>Disscount: <input placeholder="Disscount" name="discount" maxlength="10" value="<?php
  if(isset($_POST['discount'])){echo $_POST['discount'];}?>"/></p>

  <p>Tax: <input placeholder="Tax" name="tax" maxlength="10" value="<?php
  if(isset($_POST['tax'])){echo $_POST['tax'];}?>"/>(%)</p>
  
  <p>
      Shipping method: <select name="shipping">
          
          <option value="">Please choose one</option>
          <option value="5.00">Slow and steady</option>
          <option value="8.95">Put a move on it.</option>
          <option value="19.36">I need it  yesterday!</option>
          
      </select>
  </p>
      
  <p>Number of payments to make: <input placeholder="Number of payments to make" name="payments" size="3" value="<?php
  if(isset($_POST['payments'])){echo $_POST['payments'];}?>"/> </p>
      
  <p><input type="submit" name="submit" class="btn primary" value="Calculate!" /></p>

  <input type="hidden" name="submitted" value="TRUE" />

  </form>

</center>

<?php
include_once'footer.php';
?>