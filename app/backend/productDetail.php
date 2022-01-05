<?php
include("head.php");
include 'logincheck.php';
// $Util = new UtilClass();

//建立SQL---->產品----------------------
$sql = "SELECT * FROM `team1`.`product` WHERE `product_id` = ?";
//執行
$statement = $Util->getPDO()->prepare($sql);
//給值
$statement->bindValue(1, $_GET["PID"]);
$statement->execute();
$data = $statement->fetchAll();

// //建立SQL---->產品分類------------------
// $sql = "SELECT * FROM ec_category WHERE Status = 2 ORDER BY ID DESC";
// //執行
// $statement = $Util->getPDO()->prepare($sql);
// //給值
// $statement->execute();
// $cate_data = $statement->fetchAll();
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>產品修改</title>
</head>
<script type="text/javascript">
    function doSubmit() {
        if (document.getElementById('name').value == '') {
            alert("請填寫[商品名稱]");
            return false;
        }
        // if (document.getElementById('img').value == '') {
        //     alert("請選擇[商品圖片]");
        //     return false;
        // }
        if (document.getElementById('price').value == '') {
            alert("請填寫[商品金額]");
            return false;
        }
        if (document.getElementById('point').value == '') {
            alert("請填寫[商品點數]");
            return false;
        }
        // if (document.getElementById('category').value == '') {
        //     alert("請選擇[分類]");
        //     return false;
        // }
        // if (document.getElementById('cateId').value == '') {
        //     alert("未填入[商品分類編號]");
        //     return false;
        // }
        // if (document.getElementById('category2').value == '') {
        //     alert("請選擇[分類二]");
        //     return false;
        // }
    }
</script>

<body>
@@include('./base.html')
    <div class="content">
        <div class="block-responsive">
            <?php
            foreach ($data as $index => $row) {
            ?>
                <main>
                    <form method="post" action="productUpdateR.php" enctype="multipart/form-data">
                        <div class="update mb-4">
                            <p>商品名稱：</p>
                            <input type="text" name="name" id="name" value="<?= $row["product_name"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品名稱(英)：</p>
                            <input type="text" name="ename" value="<?= $row["product_ename"] ?>">
                        </div>
                        <!-- <div class="update mb-4">
                            <p>商品主圖：</p>
                            <input type="hidden" name="img" id="img">
                        </div> -->
                        <div class="update mb-4">
                            <p>商品狀態：</p>
                            <select name="productType" id="" value="">
                                <?php
                                $type = $row["product_type"];
                                switch ($type) {
                                    case '1':
                                        $type = "未上架";
                                        break;
                                    case '2':
                                        $type = "刪除";
                                        break;
                                    default:
                                        $type = "上架";
                                        break;
                                }
                                ?>
                                <option value="<?= $row["product_type"] ?>"><?= $type ?></option>
                                <option value="0">預設</option>
                                <option value="1">未上架</option>
                                <option value="2">刪除</option>
                            </select>
                        </div>
                        <div class="update mb-4">
                            <p>商品金額：</p>
                            <input type="text" name="price" id="price" value="<?= $row["product_price"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品點數：</p>
                            <input type="text" name="point" id="point" value="<?= $row["product_points"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品分類：</p>
                            <select name="category" id="category" value="">
                                <?php
                                $series = $row["product_series"];
                                switch ($series) {
                                    case '1':
                                        $series = "工程系";
                                        break;
                                    case '2':
                                        $series = "RV休旅系";
                                        break;
                                    case '3':
                                        $series = "計程車系";
                                        break;
                                    case '4':
                                        $series = "巴士系";
                                        break;
                                    case '5':
                                        $series = "警車系";
                                        break;
                                    case '6':
                                        $series = "消防救護系";
                                        break;
                                    case '7':
                                        $series = "轎車系";
                                        break;
                                    default:
                                        $series = "PREMIUM系";
                                        break;
                                }
                                ?>
                                <option value="<?= $row["product_series"] ?>"><?= $series ?></option>
                                <option value="1">工程系</option>
                                <option value="2">RV休旅系</option>
                                <option value="3">計程車系</option>
                                <option value="4">巴士系</option>
                                <option value="5">警車系</option>
                                <option value="6">消防救護系</option>
                                <option value="7">轎車系</option>
                                <option value="8">PREMIUM系</option>
                            </select>
                        </div>
                        <div class="update mb-4">
                            <p>商品分類編號：</p>
                            <input type="text" name="cateId" id="cateId" value="<?= $row["product_seriesid"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品分類二：</p>
                            <select name="category2" id="category2" value="">
                                <?php
                                $series = $row["product_spec"];
                                switch ($series) {
                                    case '1':
                                        $series = "熱門商品";
                                        break;
                                    case '2':
                                        $series = "本月主打";
                                        break;
                                    case '3':
                                        $series = "最新商品";
                                        break;
                                    case '4':
                                        $series = "點數限定";
                                        break;
                                    case '5':
                                        $series = "客製化商品";
                                        break;
                                    default:
                                        $series = "一般商品";
                                        break;
                                }
                                ?>
                                <option value="<?= $row["product_spec"] ?>"><?= $series ?></option>
                                <option value="0">一般商品</option>
                                <option value="1">熱門商品</option>
                                <option value="2">本月主打</option>
                                <option value="3">最新商品</option>
                                <option value="4">點數限定</option>
                                <option value="5">客製化商品</option>
                            </select>
                        </div>
                        <div class="update mb-4">
                            <p>商品尺寸：</p>
                            <input type="text" name="size" value="<?= $row["product_size"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品年份：</p>
                            <input type="text" name="year" value="<?= $row["product_year"] ?>">
                        </div>
                        <div class="update mb-4">
                            <p>商品描述：</p>
                            <textarea name="des" id="" cols="30" rows="10" value="<?= $row["product_des"] ?>"><?= $row["product_des"] ?></textarea>
                        </div>
                        <input type="hidden" name="PID" value="<?= $row["product_id"] ?>" />
                        <input type="hidden" name="img" id="img">

                        <div class="update mb-5">
                            <button type="submit" class="" onclick="return doSubmit();">送出</button>
                            <a href="productDelete.php?PID=<?= $row["product_id"] ?>" class="ml-5" onclick="javascript: if(confirm('確定刪除?')){ return true; } else { return false; }">刪除</a>
                        </div>
                    </form>
                </main>
                <div class="img-preview">
                    <!-- <img src="../assets/img/pic/userPic03.png"> -->
                    <?php
                    if ($row["product_year"] == 2021) {
                    ?>
                        <img src="../../upload/<?= $row['product_img'] ?>" alt="">
                    <?php
                    } else {
                    ?>
                        <img src="<?= $row['product_img'] ?>" alt="">
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>