<?php include("head.php") ?>
<title>後台登入</title>
</head>

<body>
    <div id="app">
        <!-- your code here... -->
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 col-lg-4 login-body">

                <form class="text-center form-box" method="post" action="loginr.php">
                    <h1 class="title text-center mb-6 h1">後台入口</h1>

                    <div class="form-input mb-3">
                        <!-- <span><i class="fas fa-envelope"></i></span> -->
                        <input type="account" name="account" placeholder="帳號" value="demo" tabindex="10" required>
                    </div>

                    <div class="form-input mb-6">
                        <!-- <span><i class="fas fa-key"></i></span> -->
                        <input type="password" name="pwd" placeholder="密碼" value="demo" tabindex="10" required>
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn">登入</button>
                    </div>

                    <a href="../index-front.html">回前台首頁</a>

                </form>
            </div>
        </div>

    </div>

</body>


<script>
    new Vue({
        el: '#app',
        data: {
            message: 'Hello, VueJS!',
        },
    });
</script>

</html>