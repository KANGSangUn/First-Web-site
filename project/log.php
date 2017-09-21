<?php
@$db_con = mysql_pconnect("localhost","root","gofla56",true);
mysql_select_db("ksu_test",$db_con);

$id = isset($_POST['id']) ? $_POST['id'] : null;
$pw = isset($_POST['pw']) ? $_POST['pw'] : null;

if($id==null || $pw==null)
    echo "<body onload='sitpai()'>";

$query_id = "select * from users where user_id='$id'";
$a = mysql_query($query_id);
$c = mysql_fetch_array($a);

if($id==$c[0] && $pw== $c[1]){
    session_start();
    $_SESSION['id'] = $c[0];
    $_SESSION['passwd'] = $c[1];
    echo "<script>location.href = \"board_list.php\";</script>";
}else
{
    echo "<body onload='sitpai()'>";
}
?>
<script>
    function sitpai() {
        alert("아이디 / 비밀번호를 다시 확인해 주세요!");
        location.href = "login.html";
    }

</script>