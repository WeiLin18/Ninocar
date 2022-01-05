<?php
    // include("LoginCheck.php");
    include 'logincheck.php';

    //先判斷圖片是否上傳成功?
    if($_FILES["img"]["error"] > 0){
        // echo "上傳失敗: 錯誤代碼".$_FILES["img"]["error"];
        echo "<script>alert('上架失敗'); location.href = 'update.php';</script>";
    }else{
        //Server上的暫存檔路徑含檔名
        $filePath_Temp = $_FILES["img"]["tmp_name"];

        //欲放置的檔案路徑
        // $filePath = $Util->getFilePath().$_FILES["img"]["name"];

        $filePath = "../upload/".$_FILES["img"]["name"];

        //將暫存檔搬移到正確位置
        if(copy($filePath_Temp, $filePath)){

            //取得POST過來的值
            $name = $_POST["name"]; //商品名稱
            $ename = $_POST["ename"]; //商品英文名稱
            $img = $_POST["img"];   //商品圖（主右）
            $productType = $_POST["productType"];   //商品狀態（0：預設 1：封鎖,未上架 2：刪除）
            $price = $_POST["price"];   //商品價格
            $point = $_POST["point"];   //點數售價
            $category = $_POST["category"];   //商品分類（1：工程系 2：RV休旅系 3：計程車系 4:巴士系 5:警車系 6：消防救護系 7：轎車系 8：PREMIUM系）
            $cateId = $_POST["cateId"];   //分類編號
            $category2 = $_POST["category2"];   //特殊分類（0：一般商品 1：熱門商品  2：本月主打 3：最新商品 4:點數限定 5:客製化商品 ）
            $size = $_POST["size"];   //商品尺寸
            $year = $_POST["year"];   //商品年分
            $des = $_POST["des"];   //商品描述
            //建立SQL
            $sql = "INSERT INTO `team1`.`product`(`product_name`, `product_ename`,
            `product_img`, `product_type`, `product_price`, `product_points`,
            `product_series`, `product_seriesid`, `product_spec`,
            `product_size`, `product_year`, `product_des`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

            //執行
            $statement = $Util->getPDO()->prepare($sql);

            //給值
            $statement->bindValue(1 , $name);             
            $statement->bindValue(2 , $ename);
            $statement->bindValue(3 , $_FILES["img"]["name"]);
            $statement->bindValue(4 , $productType);
            $statement->bindValue(5 , $price);
            $statement->bindValue(6 , $point);
            $statement->bindValue(7 , $category);
            $statement->bindValue(8 , $cateId);
            $statement->bindValue(9 , $category2);
            $statement->bindValue(10 , $size);
            $statement->bindValue(11 , $year);
            $statement->bindValue(12 , $des);
            $statement->execute();

            //導頁
            //header("Location: Index.php");
            echo "<script>alert('新增成功!'); location.href = 'commodity.php';</script>";
        }else{
            echo "<script>alert('上架失敗'); location.href = 'commodity.php';</script>";
        }
    }

?>