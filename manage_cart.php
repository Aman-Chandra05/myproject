
<?php 
session_start();
include 'config.php';
$id = $_POST['id'];
$type = $_POST['type'];
if(isset($_POST['qty']))
{
    $qty =$_POST['qty'];
}
$products=array();
$sql="SELECT * FROM products";
$result=$conn->query($sql);
while($row = $result->fetch_assoc())
{
  $products[]=$row;
}
if($type=='add')
{
    if(isset($_SESSION['cart']))
    {   
        $productids = array_column($_SESSION['cart'],'product_id');
        if(!in_array($id,$productids))
        {
            $count=count($_SESSION['cart']);
            foreach($products as $key=>$value)
            {
                if($value['product_id']==$id)
                {
                    $newitem=array(
                        'product_id'=>$id,
                        'name'=>$value['name'],
                        'price'=>$value['price']*$qty, 
                        'quantity'=>$qty,
                        'image'=>$value['image'],
                        'description'=>$value['description'],
                        'tag'=>$value['tag']
                    );
                    $_SESSION['cart'][$count]=$newitem;
                  //  echo "product added succseesflly";
                     break;
                }
            }
        }
    }
    else
    {
        foreach($products as $key=>$value)
        {
            if($value['product_id']==$id)
                {
                    $newitem=array(
                        'product_id'=>$id,
                        'name'=>$value['name'],
                        'price'=>$value['price']*$qty, 
                        'quantity'=>$qty,
                        'image'=>$value['image'],
                        'description'=>$value['description'],
                        'tag'=>$value['tag']
                    );
                $_SESSION['cart'][0]=$newitem;
             //   echo "product added succseesflly";
                break;
            }
        }
    }		
}
if(isset($_POST['updatecart']) && $_POST['updatecart']=='Update Cart')
{
    $arr=array();
    for($i=0;$i<count($_POST['qtys']);$i++)
    {
        $arr[$_POST['ids'][$i]]=$_POST['qtys'][$i];
    }
    //$cart=$_SESSION['cart'];
    foreach($_SESSION['cart'] as $key=>$value)
     foreach($arr as $k=>$v)
     {
         if($k==$value['product_id'])
         {
             if($value['quantity']!=$v)
             $_SESSION['cart'][$key]['quantity']=$v;
         }
     }
     header('location:cart.php');   
}

if($type=='delete')
{
    foreach($_SESSION['cart'] as $key=>$value)
    {
        if($value['product_id']==$id)
        {
            unset($_SESSION['cart'][$key]);
        }          
    }
}
echo count($_SESSION['cart']);


?>
