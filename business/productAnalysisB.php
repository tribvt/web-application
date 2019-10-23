<?php include "../data/database.php"; ?>
<?php include "../include/lib/simple_html_dom.php"; ?>

<?php
    $from = "2019-08-01";
    $to = "2019-10-31";
    $test = new ProductAnalysisB();
    $test->TEST();
    // $test->GetView(1, $from, $to);
    // $test->UpdateViewOfProduct(1);

    class ProductAnalysisB{

        private $high_view = 2;

        public function TEST(){
            // Create DOM from URL or file
            $html = file_get_html('http://www.google.com/');
            echo $html;
        }

        public function GetView($product_id, $from, $to){
            $FROM = "'" . $from . "'";
            $TO = "'" . $to . "'";

            $sql = "SELECT COUNT(*) AS NUM FROM `product_analysis` WHERE `product_id`=1 AND `visited_date`>{$FROM} AND `visited_date`<{$TO}";
            $db = new Database();
            $result = $db->select($sql);
            $row = mysqli_fetch_array($result);
            echo $row['NUM'];
            // return $result;
        }

        public function UpdateViewOfProduct($product_id){
            $now = date("Y-m-d H:i:s");
            $NOW = "'" .$now. "'";
            $sql = "INSERT INTO `product_analysis`(`product_id`, `visited_date`) VALUES ({$product_id},{$NOW})";
            $db = new Database();
            $db->insert($sql);
        }
    }
?>