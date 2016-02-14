<?php
//creation 
    function addToCart($prodId,$quantity)
        {
            session_start();
            if(!isset($_SESSION['cart']))
                {
                    $cart=array();
                }
            else
                {
                    $cart=$_SESSION['cart'];
                }
  
                    $cart[$prodId]=$quantity;
                    $_SESSION['cart']=$cart;
            session_write_close ();
        }
    function displayItems() 
        {
            session_start();
            $cart=$_SESSION['cart'];
            foreach ($cart as $key => $value) 
            {
                echo "productId: $key; Quantity: $value<br />\n";
            }
            session_write_close ();

        }
    function removeItem($prodId)
        {
            session_start();
            $cart=$_SESSION['cart'];
            unset($cart[$prodId]);
            $_SESSION['cart']=$cart;
            session_write_close ();
        }
    addToCart(100,78);
    addToCart(456,968);
    displayItems();
    removeItem(100);
    displayItems();
?>