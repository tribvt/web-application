<?php include "business/productB.php" ?>
<?php include "business/inventoryB.php" ?>

<?php
    // $test = new CategoryP();
    // $test->ShowAllCategories();
    class ProductP{

        public function ShowFeaturedProduct(){
            $from = "2019-08-01";
            $to = "2019-10-05";
            // 1. Get product list sorted by performance
            $ib = new InventoryB();
            $featuredList = $ib->GetPoorPerformanceList($from, $to);

            foreach($featuredList as $x => $x_value) {
                // echo "Key=" . $x . ", Value=" . $x_value;
                // echo "<br>";
                $pb = new ProductB();
                $result = $pb->GetProductsByID($x);
                $row = mysqli_fetch_array($result);
                $product = <<<DELIMITER
                    <div class="col-sm-4">
                        <div class="card">
                            <img class="card-img-top" src="http://placehold.it/700x400" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">{$row['product_name']}</h4>
                                <p class="card-text">\${$row['product_price']}</p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                        <br>
                    </div>
                DELIMITER;
                echo $product;
            }
        }

        public function ShowProductsInCategory(){
            $pb = new ProductB();
            $cp = new CategoryP();
            $cat_id = $cp->GetCategory();
            $result = $pb->GetAllProductsFromCategory($cat_id);

            while ($row = mysqli_fetch_array($result)){
                $product = <<<DELIMITER
                    <div class="col-sm-4">
                        <div class="card">
                            <img class="card-img-top" src="http://placehold.it/700x400" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">{$row['product_name']}</h4>
                                <p class="card-text">\${$row['product_price']}</p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                        <br>
                    </div>
                DELIMITER;
                echo $product;
            }
        }
    }
?>