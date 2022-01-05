<?php
include("head.php");
include 'logincheck.php';

//建立SQL
$sql = "SELECT * FROM product";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->execute();
$data = $statement->fetchAll();

?>
<title>商品管理</title>
</head>
<script>
    //商品名搜尋
    $(document).on('click', '.searchButton', function() {
        let textbox = $('.searchTerm').val();
        console.log(textbox);
        $.ajax({
            url: "searchProduct.php",
            method: "POST",
            data: {
                'textbox': textbox
            },
            dataType: "text",
            success: function(response) {
                //更新html內容
                document.getElementsByClassName('tbody')[0].innerHTML = response;
                // window.location.reload();
            },
            error: function(exception) {
                alert("發生錯誤: " + exception.status);
            }
        });
    });
</script>

<body>

@@include('./base.html')
    <div class="content">
        <!-- update-button -->
        <div class="update_btn">
            <div class="wrap">
                <div class="search_bar">
                    <input type="text" class="searchTerm" placeholder="搜尋">
                </div>
                <button type="text" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <button><a href="productCreate.php"><i class="fas fa-upload"></i>上架商品</a></button>
        </div>
        <!-- table -->
        <div class="col-lg-9">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>商品名稱</th>
                            <th>商品圖示</th>
                            <th>商品分類</th>
                            <th>商品金額</th>
                            <th>商品點數</th>
                            <th>商品狀態</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        foreach ($data as $index => $row) {
                        ?>
                            <tr>
                                <td><?= $row["product_name"] ?></td>
                                <td><a href="productDetail.php?PID=<?= $row["product_id"] ?>">
                                        <?php
                                        if ($row["product_year"] == 2021) {
                                        ?>
                                            <img src="../upload/<?= $row['product_img'] ?>" alt="">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?= $row['product_img'] ?>" alt="">
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </td>
                                <td>
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

                                    ?><?= $series ?></td>
                                <td><?= $row["product_price"] ?></td>
                                <td><?= $row["product_points"] ?></td>
                                <td>
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
                                    ?><?= $type ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>