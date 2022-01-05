<?php
include("head.php");
include 'logincheck.php';

//建立SQL
$sql = "SELECT * FROM team1.product";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->execute();
$data = $statement->fetchAll();
?>
<title>上架頁</title>
</head>

<script type="text/javascript">
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#img").change(function() {
            readURL(this);
        });
    });

    function doSubmit() {
        if (document.getElementById('name').value == '') {
            alert("請填寫[商品名稱]");
            return false;
        }
        if (document.getElementById('img').value == '') {
            alert("請選擇[商品圖片]");
            return false;
        }
        if (document.getElementById('price').value == '') {
            alert("請填寫[商品金額]");
            return false;
        }
        if (document.getElementById('point').value == '') {
            alert("請填寫[商品點數]");
            return false;
        }
        if (document.getElementById('category').value == '') {
            alert("請選擇[分類]");
            return false;
        }
        if (document.getElementById('cateId').value == '') {
            alert("未填入[商品分類編號]");
            return false;
        }
        if (document.getElementById('category2').value == '') {
            alert("請選擇[分類二]");
            return false;
        }
        if (document.getElementById('year').value == '') {
            alert("請選擇[商品年份]");
            return false;
        }
    }
</script>

<body>
@@include('./base.html')
    <div class="content">
        <div class="block-responsive">
            <main>
                <form method="post" action="productCreateR.php" enctype="multipart/form-data">
                    <div class="update mb-4">
                        <p>商品名稱：</p>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="update mb-4">
                        <p>商品名稱(英)：</p>
                        <input type="text" name="ename">
                    </div>
                    <div class="update mb-4">
                        <p>商品主圖：</p>
                        <input type="file" name="img" id="img" data-target="imgPreview">
                    </div>
                    <div class="update mb-4">
                        <p>商品狀態：</p>
                        <select name="productType" id="">
                            <option value="0">上架</option>
                            <option value="1">未上架</option>
                            <option value="2">刪除</option>
                        </select>
                    </div>
                    <div class="update mb-4">
                        <p>商品金額：</p>
                        <input type="text" name="price" id="price">
                    </div>
                    <div class="update mb-4">
                        <p>商品點數：</p>
                        <input type="text" name="point" id="point">
                    </div>
                    <div class="update mb-4">
                        <p>商品分類：</p>
                        <select name="category" id="category">
                            <option value="">請選擇</option>
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
                        <input type="text" name="cateId" id="cateId">
                    </div>
                    <div class="update mb-4">
                        <p>商品分類二：</p>
                        <select name="category2" id="category2">
                            <option value="">請選擇</option>
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
                        <input type="text" name="size">
                    </div>
                    <div class="update mb-4">
                        <p>商品年份：</p>
                        <input type="text" name="year" id="year">
                    </div>
                    <div class="update mb-4">
                        <p>商品描述：</p>
                        <textarea name="des" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="update mb-5">
                        <button type="submit" class="" onclick="return doSubmit();">送出</button>
                    </div>
                </form>
            </main>
            <div class="img-preview">
                <img id="imgPreview" src="">
            </div>
        </div>
    </div>
</body>

</html>