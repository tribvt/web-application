<?php include "business/productB.php" ?>
<?php include "business/inventoryB.php" ?>
<?php include "business/productAnalysisB.php" ?>

<?php
    // $test = new CategoryP();
    // $test->ShowAllCategories();
    class ProductP{
        private $from = "2019-08-01";
        private $to = "2019-10-05";

        public function ShowItem(){
            // 1. Get product ID
            $product_id = $this->GetProduct();

            // 2. Show single product
            $pb = new ProductB();
            $result = $pb->GetProductsByID($product_id);
            $row = mysqli_fetch_array($result);
            $name = $row['product_name'];
            $price = $row['product_price'];
            $this->ShowSimpleProduct($name, $price);

            // 3. Update view
            $pab = new ProductAnalysisB();
            $pab->UpdateViewOfProduct($product_id);
        }

        public function GetProduct(){
            $product_id;
            if(!isset($_GET['product_id']))
                $product_id = 0;
            else
                $product_id = $_GET['product_id'];
            return $product_id;
        }

        public function ShowSimpleProduct($name, $price){
            $product = <<<DELIMITER
                <div class="col-sm-12">
                    <div class="card">
                        <img class="card-img-top" src="http://placehold.it/700x400" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">{$name}</h4>
                            <p class="card-text">\${$price}</p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                    <br>
                </div>
            DELIMITER;
            echo $product;
        }

        public function ShowProduct($name, $price, $id){
            $product = <<<DELIMITER
                <div class="col-sm-4">
                    <div class="card">
                        <a href="items.php?product_id={$id}">
                            <img class="card-img-top" src="http://placehold.it/700x400" alt="Card image">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">{$name}</h4>
                            <p class="card-text">\${$price}</p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                    <br>
                </div>
            DELIMITER;
            echo $product;
        }

        public function ShowFeaturedProduct(){
            
            // 1. Get product list sorted by performance
            $ib = new InventoryB();
            $featuredList = $ib->GetPoorPerformanceList($this->from, $this->to);

            foreach($featuredList as $x => $x_value) {
                $pb = new ProductB();
                $result = $pb->GetProductsByID($x);
                $row = mysqli_fetch_array($result);
                $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id']);
            }
        }

        public function ShowProductsByUser(){
            $cp = new CategoryP();
            $cat_id = $cp->GetCategory();
            if ($cat_id == 0){
                $this->ShowFeaturedProduct();
            }
            else{
                $this->ShowProductsInCategory($cat_id);
            }
        }

        public function ShowProductsInCategory($cat_id){
            $pb = new ProductB();
            $result = $pb->GetAllProductsFromCategory($cat_id);

            while ($row = mysqli_fetch_array($result)){
                $this->ShowProduct($row['product_name'],$row['product_price'],$row['product_id']);
            }
        }
    }
?>