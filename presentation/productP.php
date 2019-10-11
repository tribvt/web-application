<?php include "business/productB.php" ?>
<?php
    // $test = new CategoryP();
    // $test->ShowAllCategories();
    class ProductP{
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