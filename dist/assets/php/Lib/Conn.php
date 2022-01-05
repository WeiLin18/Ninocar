<?php
    class UtilClass {    

        // 取得欲放置的檔案路徑
        // function getFilePath(){
        //     //Web根目錄真實路徑
        //     $ServerRoot = $_SERVER["DOCUMENT_ROOT"];
        //     return $ServerRoot."/ninocar/dist";  
        // }

        //取得PDO物件
        function getPDO(){
            // $db_host = "127.0.0.1";
            // // $db_host = "localhost";
            // $db_user = "root";
            // $db_pass = "za0000";
            // // $db_pass = "password";
            // $db_select = "team1";
            
            //將資料庫轉移至周杰的網域
            $db_host = "10.2.0.202";
            $db_user = "test";
            $db_pass = "12345678";
            $db_select = "team1";

            //  $db_host = "localhost";
            // $db_user = "tibamefe_ted102";
            // $db_pass = "qweasdzxc123";
            // $db_select = "tibamefe_ted102_g1";

       
            //建立資料庫連線物件
            $dsn = "mysql:host=".$db_host.";dbname=".$db_select;
       
            //建立PDO物件，並放入指定的相關資料
            // $pdo = new PDO($dsn, $db_user);
            $pdo = new PDO($dsn, $db_user, $db_pass);
    
            return $pdo;
        }

    }
?>