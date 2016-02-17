<?php
class Cart
{
    public $user_id;
    function __construct() 
        {
        include "dbconnect.php";
        session_start();
        $query="select user_id from user where email = '".$_SESSION['username']."'";
        $rslt=mysqli_query($con,$query);
           while($row=mysqli_fetch_row($rslt)) {
                $user_id=$row[0];
                } 
        session_write_close();
        $this->generateCart();
        }
    public function generateCart()
        {
            echo "<div class='container'><div class='row'>";
            echo "<div class='col-md-9'>Product</div>";
            echo "<div class='col-md-1'>Quantity</div>";
            echo "<div class='col-md-2'>Price</div>";
            echo "</div></div><hr>";
                echo "<div class='container'><div class='row'>";  
                $query="select product_id_cart from cart_line where user_id_cart = '".$this->user_id."'";
                $rslt=mysqli_query($con,$query);
                $total=0;
                while($row=mysqli_fetch_row($rslt)) {
                    $pro_id=$row[1];
                    echo $pro_id;
                    $total=$total+$this->printItem($pro_id);
                    } 
                echo "</div></div><hr>";
            echo"generating cart";
        }
    public function printItem($pid)
        {
            echo $pid;
            $query="select name,image,price from product where product_id = ".$pid."";
                $rslt=mysqli_query($con,$query);
                while($row=mysqli_fetch_row($rslt)) {
                    $pro_id=$row[1];
                    $price=$row[2];
                    echo $pro_id;
                    } 
            return $price;
        }
    public function isEmpty()
    	{
    		echo count($this->items);
    	}
    function __destruct() 
        {
            print "Destroying \n";
            mysqli_close($con);
        }
}
?>
