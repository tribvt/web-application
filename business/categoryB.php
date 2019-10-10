<?php include "data/database.php" ?>
<?php
    // $test = new CategoryB();
    // $test->GetAllCategories();
    class CategoryB{
        public function GetAllCategories(){
            $sql = "SELECT * FROM category";
            $db = new Database();
            $result = $db->select($sql);

            // while ($row = mysqli_fetch_array($result)){
            //     echo $row['cat_name'];
            // }

            return $result;
        }
    }
?>