$(document).ready(function(){
  console.log("myjs");

    $('.aa-add-card-btn').click(function(){
        var productid=$(this).data('productid');
        var type=$(this).data('type');
        var qty=$(this).data('qty');
       $.ajax({
            method: "POST",
            url: "manage_cart.php",
            data: { id: productid, type:type, qty:qty   }
          })
          .done(function( msg ) {
 
            $('.aa-cart-notify').html(msg)
           });
   
    });
    $('.remove').click(function(){
      console.log("inside");
      var productid=$(this).data('productid');
      var type=$(this).data('type');
      console.log(productid);
      console.log(type);
      /*if(type=='delete')
      {        console.log("deleter red");

        window.location.href='cart.php';
      }*/
      $.ajax({
        method: "POST",
        url: "manage_cart.php",
        data: { id: productid, type:type}
      })
        .done(function( msg ) {
         window.location.href='cart.php';
        });
  });

});
