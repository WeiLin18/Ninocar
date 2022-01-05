<?php
include("head.php");
include 'logincheck.php';

//建立SQL
$sql = "SELECT * FROM member";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->execute();
$data = $statement->fetchAll();

?>
<title>會員管理</title>
</head>
<script>
    //會員名字搜尋
    $(document).on('click', '.searchButton', function() {
        let textbox = $('.searchTerm').val();
        console.log(textbox);
        $.ajax({
            url: "searchMember.php",
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

    //封鎖 解鎖
    $(document).on('click', '.alert', function() {
        let MID = $(this).parents('tr').children('input')[0].value;
        console.log(MID);
        if (confirm("確定封鎖該會員?")) {
            $.ajax({
                url: "sendBan.php",
                method: "POST",
                data: {
                    'MID': MID,
                },
                dataType: "text",
                success: function(response) {
                    //更新html內容
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
        let MID = $(this).parents('tr').children('input')[0].value;
        // console.log(MID);
        if (confirm("確定恢復狀態?")) {
            $.ajax({
                url: "sendUnlock.php",
                method: "POST",
                data: {
                    'MID': MID,
                },
                dataType: "text",
                success: function(response) {
                    //更新html內容
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
        </div>
        <!-- table -->
        <div class="col-lg-9">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>會員等級</th>
                            <th>會員姓名</th>
                            <th>會員狀態</th>
                            <th>註冊日期</th>
                            <th>封鎖</th>
                            <th>解鎖</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        foreach ($data as $index => $row) {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    $level = $row["member_level"];
                                    switch ($level) {
                                        case '1':
                                            $level = "黃金";
                                            break;
                                        case '2':
                                            $level = "白金";
                                            break;
                                        default:
                                            $level = "一般";
                                            break;
                                    }
                                    ?>
                                    <?= $level ?>
                                </td>
                                <td><a href="memberDetail.php?MID=<?= $row["member_id"] ?>"><?= $row["member_name"] ?></a></td>
                                <td>
                                    <?php
                                    $type = $row["member_type"];
                                    switch ($type) {
                                        case '1':
                                            $type = "封鎖";
                                            break;
                                        default:
                                            $type = "開通";
                                            break;
                                    }
                                    ?>
                                    <?= $type ?></td>
                                <td><?= $row["member_signdate"] ?></td>
                                <input type="hidden" name="MID" value="<?= $row["member_id"] ?>" />
                                <td><button type="button" class="alert" id="<?= $row["member_id"] ?>"><i class="fas fa-ban"></i></button></td>
                                <td><button type="button" class="return" id="<?= $row["member_id"] ?>"><i class="fas fa-unlock"></i></button></td>
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