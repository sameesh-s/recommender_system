<?php
class Product
{   public $prod_id;
    public $name;
    public $category_id;
    public $image;
    public $price;
    public $brand;
    function __construct($param) 
        {
        include "dbconnect.php";
        $this->prod_id=$param;
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
            echo "<div class='col-md-8'><h1>".$this->name."</h1>";
                echo "<br>Category :".$this->category_id;
                echo "<br>Brand :".$this->brand;
                echo "<br>price :".$this->price."<hr>";
                echo "<br><input type='submit' value='Add to Cart' onclick='addCart();'>";
            echo "&nbsp<input type='submit' value='Add to Wishlist' onclick='addWish();'></div>";
            echo "</div></div><hr>";
        }
    public function printCartItem($quantity)
        {
            echo "<div class='container'><div class='row'>";
            echo "<div class='col-md-2'>";
                echo "<img class='img-rounded img-responsives' width='100%' src='images/".$this->image."'>";
                echo "</div>";
            echo "<div class='col-md-10'><h1>".$this->name."</h1>";
                echo "<br>Category :".$this->category_id;
                echo "<br>Brand :".$this->brand;
                echo "<br>price :".$this->price."<hr>";
                echo "<br>Total :".$this->price*$quantity;
            echo "<a href='Login.html'><i class='glyphicon glyphicon-earphone'></i>Remove </a>&nbsp|&nbsp<a href='addToWish.php?prod_id=".$this->prod_id."'>Move To Wishlist</a>";
            echo "</div></div></div><hr>";
        }
    function __destruct() 
        {   //print "Destroying \n";
            mysqli_close($con);
        }
}
?>
