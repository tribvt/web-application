
<?php
    // $test = new ProductB();
    // $test->GetAllProductsFromCategory(3);
    class ProductB{

        public function GetProductsByID($product_id){
            $sql = "SELECT * FROM product WHERE product_id={$product_id}";
            $db = new Database();
            $result = $db->select($sql);

            // while ($row = mysqli_fetch_array($result)){
            //     echo $row['product_name'];
            // }

            return $result;
        }

        public function GetAllProductsFromCategory($cat_id){
            $sql = "SELECT * FROM product WHERE cat_id={$cat_id}";
            $db = new Database();
            $result = $db->select($sql);

            // while ($row = mysqli_fetch_array($result)){
            //     echo $row['product_name'];
            // }

            return $result;
        }
    }
?>