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

<!-- <input type="checkbox" id="check"> -->
<!--header area start-->
<header>
  <!-- <label for="check">
    <i class="fas fa-bars" id="sidebar_btn"></i>
  </label> -->
  <div class="left_area">
    <a href="" class="logo">
      <svg xmlns="http://www.w3.org/2000/svg" width="160" height="30" viewBox="0 0 160 30">
        <g transform="translate(-2903 -1670)">
          <path d="M70.215,346.391c0,1.045.156,2.2-.3,2.786-.422.585-1.292.446-2.558.446s-2.068.139-2.49-.446c-.454-.591-.364-1.74-.364-2.786V330.422c0-1.4,1-2.284,3.178-2.284a4.18,4.18,0,0,1,3.892,1.958l7.2,9.927v-8.653c0-1.046-.112-2.2.342-2.785.419-.585,1.248-.447,2.511-.447s2.024-.139,2.446.447a5.163,5.163,0,0,1,.41,2.785v16c0,1.566-1.006,2.35-2.758,2.35a3.937,3.937,0,0,1-3.5-1.862l-8.01-10.545Z" transform="translate(2842.501 1345.877)" fill="#3f1b0f" />
          <path d="M112.247,344.522a6.062,6.062,0,0,0,2.272-.457,10.145,10.145,0,0,1,2.745-.943c1.525,0,1.828,2.021,1.828,3.2,0,.912.022,1.472-1.017,2.093a14.035,14.035,0,0,1-6.12,1.5c-6.066,0-10.574-4.146-10.574-10.9,0-7.25,5.157-10.942,10.737-10.942a13.91,13.91,0,0,1,5.936,1.213c1.1.651,1.039,1.5,1.039,2.381,0,1.143-.228,2.972-1.85,2.972a9.713,9.713,0,0,1-2.918-.72,6.184,6.184,0,0,0-2.272-.457c-2.564,0-4.7,1.8-4.7,5.489C107.35,342.826,109.751,344.522,112.247,344.522Z" transform="translate(2897.619 1345.936)" fill="#512616" />
          <path d="M122.969,345.248h-7.234l-.941,2.372c-.681,1.892-1.136,2-3.178,2-1.85,0-2.652-.452-2.652-1.5a5.037,5.037,0,0,1,.478-1.639l6.618-15.806c.682-1.666,1.46-2.546,3.535-2.546,2.109,0,2.791.912,3.44,2.546l6.388,15.839a5.8,5.8,0,0,1,.352,1.566c0,1.174-.969,1.536-2.816,1.536-1.947,0-2.266.229-3.013-1.794Zm-5.612-4.506h4.021l-2.012-5.487Z" transform="translate(2910.036 1346.06)" fill="#3f1b0f" />
          <path d="M123.64,346.432a5.09,5.09,0,0,1-.418,2.684c-.422.585-1.14.548-2.373.548s-1.941.038-2.363-.548a5.084,5.084,0,0,1-.426-2.684v-14.6c0-1.176,0-2.581,2.077-3.235a15.671,15.671,0,0,1,4.508-.487,13.065,13.065,0,0,1,5.579.977,5.962,5.962,0,0,1,3.567,5.781,6.363,6.363,0,0,1-3.31,5.846l3.824,5.1,1.091,1.4c1.036,1.4-.047,2.448-2.838,2.448-2.142,0-2.675-.39-3.681-1.923l-2.515-3.923c-.581-.915-1.036-1.794-1.036-1.794H123.64Zm0-8.915s.454.033.906.033c2.4,0,3.343-.948,3.343-2.353,0-1.634-1.266-2.154-2.951-2.154a9,9,0,0,0-1.3.1Z" transform="translate(2924.037 1346.019)" fill="#3f1b0f" />
          <g class="logo__child">
            <path d="M79.843,341.791c0,.554-.059.947-.5,1.152a5.991,5.991,0,0,1-2.464.281c-1.441,0-1.988-.024-2.488-.336s-.506-.8-.506-1.349l-.281-6.326c0-2.74,1.4-3.408,3.275-3.408,1.763,0,3.272.449,3.272,3.508Z" transform="translate(2857.399 1352.276)" fill="#3f1b0f" />
            <path d="M3.014,6.028A3.014,3.014,0,1,1,6.028,3.014,3.018,3.018,0,0,1,3.014,6.028ZM3,3.808c-.763,0-1.133.126-1.133.387a.83.83,0,0,0,.384.547A1.335,1.335,0,0,0,3,5.036a1.335,1.335,0,0,0,.749-.294.83.83,0,0,0,.384-.547C4.13,3.935,3.76,3.808,3,3.808Z" transform="translate(2931.234 1677.165)" fill="#3f1b0f" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1" />
          </g>
          <path d="M70.215,346.391c0,1.045.156,2.2-.3,2.786-.422.585-1.292.446-2.558.446s-2.068.139-2.49-.446c-.454-.591-.364-1.74-.364-2.786V330.422c0-1.4,1-2.284,3.178-2.284a4.18,4.18,0,0,1,3.892,1.958l7.2,9.927v-8.653c0-1.046-.112-2.2.342-2.785.419-.585,1.248-.447,2.511-.447s2.024-.139,2.446.447a5.163,5.163,0,0,1,.41,2.785v16c0,1.566-1.006,2.35-2.758,2.35a3.937,3.937,0,0,1-3.5-1.862l-8.01-10.545Z" transform="translate(2877.501 1345.877)" fill="#3f1b0f" />
        </g>
        <g>
          <path d="M97.356,328.182a10.935,10.935,0,1,0,10.861,10.936A10.941,10.941,0,0,0,97.356,328.182Zm0,4.315a6.627,6.627,0,0,1,6.307,4.764.5.5,0,0,0-.254-.275,13.651,13.651,0,0,0-12.108,0,.5.5,0,0,0-.254.275A6.627,6.627,0,0,1,97.356,332.5Zm-6.447,7.925a.5.5,0,0,0,.414.37l1.209.169a3.555,3.555,0,0,1,2.991,3.011l.168,1.217a.5.5,0,0,0,.3.389A6.655,6.655,0,0,1,90.908,340.423Zm6.447.215a1.521,1.521,0,1,1,1.509-1.519A1.519,1.519,0,0,1,97.356,340.638Zm1.366,4.941a.5.5,0,0,0,.3-.389l.168-1.217a3.557,3.557,0,0,1,2.991-3.011l1.209-.169a.507.507,0,0,0,.416-.37A6.658,6.658,0,0,1,98.721,345.579Z" transform="translate(-23.492 -324.04)" fill="#3f1b0f" />
          <animateTransform attributeName="transform" dur="2s" type="rotate" values="-30 73.8 14.9;30 73.8 14.9;-30 73.8 14.9" additive="sum" repeatCount="indefinite"></animateTransform>
        </g>
      </svg>
      <h1 class="logo__h1">NiNO CAR</h1>
    </a>
    <!-- <h3>NINO CAR</h3> -->
  </div>
  <div class="right_area">
    <a href="logout.php" class="logout_btn">登出</a>
    <!-- <button type="submit" class="btn btn--small">登出</button> -->
  </div>
</header>
<!--header area end-->
<!--mobile navigation bar start-->
<div class="mobile_nav">
  <div class="nav_bar">
    <img src="../assets/img/pic/userPic03.png" class="mobile_profile_image" alt="">
    <!-- <i class="fa fa-bars nav_btn"></i> -->
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon nav_btn" for="menu-btn"><span class="navicon"></span></label>
  </div>
  <div class="mobile_nav_items">
    <a href="commodity.php"><i class="fas fa-car"></i><span>商品管理</span></a>
    <a href="order.php"><i class="fas fa-money-bill"></i><span>訂單管理</span></a>
    <a href="member.php"><i class="fas fa-user-alt"></i><span>會員管理</span></a>
    <a href="comment.php"><i class="fas fa-comment-dots"></i><span>留言管理</span></a>
  </div>
</div>
<!--mobile navigation bar end-->
<!--sidebar start-->
<div class="sidebar">
  <div class="profile_info">
    <img src="../assets/img/pic/userPic03.png" class="profile_image" alt="">
    <h4>管理員</h4>
  </div>
  <a href="commodity.php"><i class="fas fa-car"></i><span>商品管理</span></a>
  <a href="order.php"><i class="fas fa-money-bill"></i><span>訂單管理</span></a>
  <a href="member.php"><i class="fas fa-user-alt"></i><span>會員管理</span></a>
  <a href="comment.php"><i class="fas fa-comment-dots"></i><span>留言管理</span></a>
</div>
<!--sidebar end-->

<!-- <div class="content"></div> -->

<script type="text/javascript">
  $(document).ready(function () {
    $('.nav_btn').click(function () {
      $('.mobile_nav_items').toggleClass('active');
    });
  });
  $(".logo").attr("disabled",true).css("pointer-events","none");
</script>
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