<?php
include("head.php");
include 'logincheck.php';

//建立SQL
$sql = "SELECT * FROM `order`";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->execute();
$data = $statement->fetchAll();

?>
<title>訂單管理</title>
</head>

<body>
@@include('./base.html')
    <div class="content">
        <!-- table -->
        <div class="col-lg-9">
            <div class="table-responsive">
                <!-- <button class="update_btn mb-3 ml-3"><i class="fas fa-upload"></i>上架商品</button> -->
                <table>
                    <thead>
                        <tr>
                            <th>訂單日期</th>
                            <th>會員編號</th>
                            <th>訂單金額</th>
                            <th>訂單點數</th>
                            <th>貨物狀態</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $index => $row) {
                        ?>
                            <tr>
                                <td><?= $row["order_date"] ?></td>
                                <td><a href="memberDetail.php?MID=<?= $row["member_id"] ?>"><?= $row["member_id"] ?><a></td>
                                <td><?= $row["order_cost"] ?></td>
                                <td><?= $row["order_points"] ?></td>
                                <td>
                                    <?php
                                    $type = $row["deliver_type"];
                                    switch ($type) {
                                        case '1':
                                            $type = "出貨中";
                                            break;
                                        case '2':
                                            $type = "已送達";
                                            break;
                                        default:
                                            $type = "處理中";
                                            break;
                                    }
                                    ?>
                                    <?= $type ?></td>
                                <td><a href="orderDetail.php?OID=<?= $row["order_id"] ?>">查看</a></td>
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