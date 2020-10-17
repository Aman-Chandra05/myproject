if(sizeof($error)==0)
	{
		$sql = "SELECT * FROM products WHERE `name`='".$name."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$error[]=array('input'=>'form','msg'=>"Product already exists");
 
		}
		else
		{  					$msg="helllllllllllll";

			if(isset($_GET['operation'])&& isset($_GET['id']))
			{  
				$id=$_GET['id'];
				if($_GET['operation']=='edit')
				{ 
				}		   
			}
			else
			{
				$image=$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'products/'.$_FILES['image']['name']);
				$sql = "INSERT INTO products (`category_id`, `name`, `price`,`description`,`image`,`tag`) VALUES ('".$category."', '".$name."', '".$price."', '".$description."','".$image."','".$b."')";
				$result = $conn->query($sql);
			   if($result==TRUE)
			   {
				   $msg="Product added!!!";
			   }	
			}
		   header('location:products.php');  
		}
	}
