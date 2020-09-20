<?php
	include("conexion/conectar.php");

	if(!empty($_GET["action"])) 
	{
		$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
		$cantidad = isset($_POST['cantidad']) ? htmlspecialchars($_POST['cantidad']) : '';

		switch($_GET["action"])
		{
			case "add":
				if(!empty($cantidad))
				{
					$stmt = $db->prepare("SELECT * FROM productos where p_id= ?");
					$stmt->bind_param('i',$productId);
					$stmt->execute();
					$productDetails = $stmt->get_result()->fetch_object();
					$itemArray = array($productDetails->p_id=>array('titulo'=>$productDetails->titulo, 'p_id'=>$productDetails->p_id, 'cantidad'=>$cantidad, 'precio'=>$productDetails->precio));
					if(!empty($_SESSION["cart_item"])) 
					{
						if(in_array($productDetails->p_id,array_keys($_SESSION["cart_item"]))) 
						{
							foreach($_SESSION["cart_item"] as $k => $v) 
							{
								if($productDetails->p_id == $k) 
								{
									if(empty($_SESSION["cart_item"][$k]["cantidad"])) 
									{
										$_SESSION["cart_item"][$k]["cantidad"] = 0;
									}
										$_SESSION["cart_item"][$k]["cantidad"] += $cantidad;
								}
							}
						}
						else 
						{
							$_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
						}
					} 
					else 
					{
						$_SESSION["cart_item"] = $itemArray;
					}
				}

				header("location:productos.php?p_id=".$productId);

				break;
					
			case "remove":
				if(!empty($_SESSION["cart_item"]))
				{
					foreach($_SESSION["cart_item"] as $k => $v) 
					{
						if($productId == $v['p_id'])
						unset($_SESSION["cart_item"][$k]);
					}
				}

				header("location:productos.php?p_id=".$productId);

				break;
					
			case "empty":
				unset($_SESSION["cart_item"]);
				
				break;
					
			case "check":
				if(!empty($_SESSION["cart_item"])){
					header("location:chequear.php");
				}
				else{
					header("location:productos.php");
				}
				break;
		}
	}
?>
