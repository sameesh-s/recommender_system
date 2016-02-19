<?php
class Product
{   public $prod_id;
    public $name;
    public $category_id;
    public $image;
    public $price;
    public $brand;
    function __construct() 
        {
        include "dbconnect.php";
        $this->prod_id=$_GET['prodid'];
        $this->generateScript();
        $query="select category_id,brand,name,image,price from product where product_id = ".$this->prod_id."";
        $rslt=mysqli_query($con,$query);
           while($row=mysqli_fetch_row($rslt)) {
                $this->category_id=$row[0];
                $this->brand=$row[1];
                $this->name=$row[2];
                $this->image=$row[3];
                $this->price=$row[4];
                } 
        $this->printBasic();
        }
    public function generateScript()
        {
            echo "<script type='text/javascript'>
                function addCart(){ 
                    $.ajax({url: 'addToCart.php?prod_id=".$this->prod_id."' });
                    }
                function addWish(){ 
                    $.ajax({url: 'addToWish.php?prod_id=".$this->prod_id."' });
                    }
                function ck(){ 
                    $.ajax({url: 'start.php'});
                    }
                function end(){
                    $.ajax({url:'stop.php?prod_id=".$this->prod_id."'});
                    }
                window.unload=end();
                </script><body onload=ck();>";
        }
    public function printBasic()
        {
            echo "<div class='container'><div class='row'>";
            echo "<div class='col-md-4'>";
                echo "<img class='img-rounded img-responsives' width='100%' src='images/".$this->image."'>";
                echo "</div>";
            echo "<div class='col-md-6'><h1>".$this->name."</h1>";
                echo "<br>Category :".$this->category_id;
                echo "<br>Brand :".$this->brand;
                echo "<br>price :".$this->price."</div>";
            echo "<div class='col-md-2'>";
            echo "<input type='submit' value='Add to Cart' onclick='addCart();'>";
            echo "<input type='submit' value='Add to Wishlist' onclick='addWish();'>";
            echo "</div>";
            echo "</div></div><hr>";
        }
    public function printItem($pid)
        {
        }
    function __destruct() 
        {   //print "Destroying \n";
            mysqli_close($con);
        }
}
?>
