<?php
    include("../assets/php/Lib/MemberClass.php");
    $Member = new MemberClass();
    
    //登入檢查
    if($Member->getSessionB() == ""){
        echo "<script>alert('請先登入'); location.href = './index.php';</script>";
    }else{
        include("../assets/php/Lib//UtilClass.php");
        $Util = new UtilClass();
    }
?>