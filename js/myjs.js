$(document).ready(function(){
    console.log("present");
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
          var productid=$(this).data('productid');
          var type=$(this).data('type');
          $.ajax({
            method: "POST",
            url: "manage_cart.php",
            data: { id: productid, type:type}
          })
            .done(function( msg ) {
             window.location.href='cart.php';
            });
      });
  
      $('.forquickviews').click(function(){
          var id=$(this).data('productid');
          $('#pqty').val(1);
          $.ajax({
              method: "POST",
              url: "quickview.php",
              data: { id: id},
              dataType: "json"
            })
              .done(function( msg ) {
              $('.qname').html(msg.product.name);
              $('.aa-product-view-price').html("Rs. "+msg.product.price);
              $('.aa-prod-category').html("Category: <a href='#'>"+msg.product.category_name+"</a>");
              $('.qdesc').html(msg.product.description);
              $('.simpleLens-big-image-container').html("<a class='simpleLens-lens-image' data-lens-image='admin/products/large/"+msg.product.image+"'><img src='admin/products/medium/"+msg.product.image+"' class='simpleLens-big-image'>");
              $('.simpleLens-thumbnails-container').html("<a href='#' class='simpleLens-thumbnail-wrapper' data-lens-image='admin/products/large/"+msg.product.image+"' data-big-image='admin/products/medium/"+msg.product.image+"'> <img style='width:45px; height:55px' src='admin/products/"+msg.product.image+"'> </a>"+
                                                         "<a href='#' class='simpleLens-thumbnail-wrapper' data-lens-image='admin/products/large/"+msg.product.image+"' data-big-image='admin/products/medium/"+msg.product.image+"'> <img style='width:45px; height:55px' src='admin/products/"+msg.product.image+"'> </a>"+
                                                         "<a href='#' class='simpleLens-thumbnail-wrapper' data-lens-image='admin/products/large/"+msg.product.image+"' data-big-image='admin/products/medium/"+msg.product.image+"'> <img style='width:45px; height:55px' src='admin/products/"+msg.product.image+"'> </a>");                         
              });
              $('.aa-add-to-cart-btn').click(function(){
                var type=$(this).data('type');
                var qty=$('#pqty').val();
                console.log(id);
                console.log(type);
                console.log(qty);
               $.ajax({
                    method: "POST",
                    url: "manage_cart.php",
                    data: { id: id, type:type, qty:qty   }
                  })
                  .done(function( msg ) {
         
                    $('.aa-cart-notify').html(msg)
                   }); 
            });   
        });
        $('.aa-add-to-cart-btn').click(function(){
            var id=$(this).data('productid');
            var type=$(this).data('type');
            var qty=$('#pqty').val();
           $.ajax({
                method: "POST",
                url: "manage_cart.php",
                data: { id: id, type:type, qty:qty   }
              })
              .done(function( msg ) {
     
                $('.aa-cart-notify').html(msg)
               }); 
        });  
        $('#regbtn').click(function(){
          var name=$('#username').val();
          var email=$('#email').val();
          var password=$('#password').val();
          $.ajax({
            method: "POST",
            url: "register.php",
            data: { name: name, email:email, password:password   }
          })
          .done(function( msg ) {
            if(msg=='present')
            {
              $('#reg_msg').html("<br><p style='color:red; font:large'> Email already registered </p>");
            }
            if(msg=='inserted')
            {
              $('#reg_msg').html("<br><p style='color:green; font:large'> Thank You for Registrating </p>");
            }
           });  
      });
      $('#loginbtn').click(function(){
        var email=$('#login_email').val();
        var password=$('#login_pass').val();
        console.log(email);
        console.log(password);

        $.ajax({
          method: "POST",
          url: "login.php",
          data: { email:email, password:password   }
        })
        .done(function( msg ) {
          if(msg=='present')
          {
            window.location.href='product.php';
          }
          if(msg=='wrong')
          {
            $('#log_msg').html("<br><p style='color:red; font:large'> Enter correct login details </p>");
          }
          //console.log(msg);
         });  
    });


  
  
    });