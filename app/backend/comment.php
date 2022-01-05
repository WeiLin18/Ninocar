<?php
include("head.php");
include 'logincheck.php';

//建立SQL
$sql = "SELECT * FROM comment";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->execute();
$data = $statement->fetchAll();

?>
<title>留言管理</title>
</head>
<script>
    $(document).on('click', '.alert', function() {
        let CID = $(this).parents('tr').children('input')[0].value;
        let MID = $(this).parents('tr').children('input')[1].value;
        // console.log(CID);
        // console.log(MID);
        if (confirm("確定寄送警告信?")) {
            $.ajax({
                url: "sendAlert.php",
                method: "POST",
                data: {
                    'CID': CID,
                    'MID': MID,
                },
                dataType: "text",
                success: function(response) {
                    //更新html內容
                    // document.getElementById('comment')[1].innerHTML = response;
                    // console.log(response);
                    window.location.reload();
                },
                error: function(exception) {
                    alert("發生錯誤: " + exception.status);
                }
            });
        } else {
            return false;
        }
    });
    $(document).on('click', '.return', function() {
        let CID = $(this).parents('tr').children('input')[0].value;
        let MID = $(this).parents('tr').children('input')[1].value;
        // console.log(CID);
        // console.log(MID);
        if (confirm("確定恢復狀態?")) {
            $.ajax({
                url: "sendSorry.php",
                method: "POST",
                data: {
                    'CID': CID,
                    'MID': MID,
                },
                dataType: "text",
                success: function(response) {
                    //更新html內容
                    // document.getElementById('comment')[1].innerHTML = response;
                    // console.log(response);
                    window.location.reload();
                },
                error: function(exception) {
                    alert("發生錯誤: " + exception.status);
                }
            });
        } else {
            return false;
        }
    });
</script>

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
                            <th>留言板編號</th>
                            <th>會員編號</th>
                            <th>留言內容</th>
                            <th>留言狀態</th>
                            <th>警告</th>
                            <th>恢復</th>
                        </tr>
                    </thead>
                    <form method="post" action="commentUpdate.php" enctype="multipart/form-data">
                        <tbody id="comment">
                            <?php
                            foreach ($data as $index => $row) {
                            ?>
                                <tr>
                                    <td><?= $row["board_id"] ?></td>
                                    <td><a href="memberDetail.php?MID=<?= $row["member_id"] ?>"><?= $row["member_id"] ?><a></td>
                                    <td><?= $row["comment_content"] ?></td>
                                    <td>
                                        <?php
                                        $type = $row["comment_type"];
                                        switch ($type) {
                                            case '1':
                                                $type = "封鎖";
                                                break;
                                            default:
                                                $type = "正常";
                                                break;
                                        }

                                        ?>
                                        <?= $type ?></td>
                                    <input type="hidden" name="CID" value="<?= $row["comment_id"] ?>" />
                                    <input type="hidden" name="MID" value="<?= $row["member_id"] ?>" />
                                    <td><button type="button" class="alert" id="<?= $row["member_id"] ?>"><i class="fas fa-exclamation-circle"></i></button></td>
                                    <td><button type="button" class="return" id="<?= $row["member_id"] ?>"><i class="fas fa-redo-alt"></i></button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>
</body>

</html>