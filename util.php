<?php

function dbconnect($host,$id,$pass,$db){    // 데이터베이스 연결
    $connect = mysqli_connect($host,$id,$pass,$db);
    if($connect == false){
        die('Database Not Connected :'.mysqli_error());
    }

    return $connect;
}

function msg($msg){ // 경고 메세지 출력 후 이전 페이지로 이동
    echo "
        <meta http-equiv=\"Content-Type\"content=\"text/html; charset=euc-kr\"/>
        <script>
            window.alert('$msg');
            history.go(-1);
        </script>
    ";
}


function s_msg($msg){   // 일반 메세지 출력
    echo "
        <meta http-equiv=\"Content-Type\"content=\"text/html; charset=euc-kr\"/>
        <script>
            window.alert('$msg');
        </script>
    ";
}

function check_injection($input){
    $input = preg_replace("/[\r\n\s\t\’\;\”\=\-\-\#\/*]+/”,“", $input);
    if(preg_match('/(union|select|from|where)/i', $input)){
        msg("No SQL-Injection");
    }
}