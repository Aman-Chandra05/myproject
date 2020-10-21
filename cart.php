
 <?php include 'header.php'; ?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <?php if(count($_SESSION['cart'])!=0)
         { ?>
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="manage_cart.php" method="POST">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <?php if(isset($_SESSION['cart']) && (count($_SESSION['cart'])!=0))
                      { $total_price=0;
                        $price=0;
                        echo '<tbody>';
                        foreach($_SESSION['cart'] as $key=>$value)
                        {  $i=0;$i++; $edit=array();                
                       ?>
                      <tr>
                        <td><a class="remove" href="#"data-productid="<?php echo $value['product_id'];?>"data-type="delete"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="admin/products/<?php echo $value['image'];?>" alt="<?php echo $value['name'];?>"></a></td>
                        <td><a class="aa-cart-title" href="#"><?php echo $value['name'];?></a></td>
                        <td>Rs.<?php echo $value['price'];?></td>
                        <td><input class="aa-cart-quantity" type="number"  name="qtys[]"value="<?php echo $value['quantity'];?>">
                            <input type="hidden"  name="ids[]" value="<?php echo $value['product_id']; ?>">
                        </td>
                        <td>Rs.<?php $price=$value['quantity'] * $value['price']; echo $price; ?></td>
                      </tr>
                        <?php
                        $total_price=$total_price+$price ; 
                        } 
                        ?>
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart" name='updatecart'>
                        </td>
                      </tr>
                      </tbody>
                      <?php
                    } ?>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>Rs.<?php echo $total_price;?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>Rs.<?php echo $total_price;?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
         <?php 
         }?>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <?php include 'footer.php' ?>


