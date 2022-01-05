<?php
    include("../assets/php/Lib/MemberClass.php");
    $Member = new MemberClass();

    //清空session
    $Member->clearSession();

    echo "<script>alert('登出成功!'); location.href = 'index.php';</script>";  
?>