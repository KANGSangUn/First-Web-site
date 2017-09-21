<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
    .all {
        width: 70%;
        height: 70%;
        margin: 40px auto;

    }
    .post {
        font-size: larger;
        border: groove;
    }
    .post_contents {
        min-height: 350px;

    }
    .td_A {
        table-layout: fixed;
        text-align: center;

    }
    .td_B {
        width: 2000px;
    }

</style>
<div>
<?php

@$db_data = mysql_pconnect("localhost","root","gofla56",true);
mysql_select_db("ksu_test",$db_data);
$post_num = isset($_GET['this_post']) ? $_GET['this_post'] : null;

$id = isset($_POST['id']) ? $_POST['id'] : null;
$pw = isset($_POST['pw']) ? $_POST['pw'] : null;
$cookie_name = $post_num;

if(isset($_COOKIE[$cookie_name])){

}else{
    setcookie($cookie_name,"hi");
    $cookie_query = "update board set hits = hits + 1 where board_id=".$post_num;
    mysql_query($cookie_query);
}

$query = "select * from board where board_id='$post_num'";
$page = mysql_query($query);
$view = mysql_fetch_array($page);

?>
    <div class="all">

          <h1> <?php echo $view[3] ?> </h1>
        <div class="post">
            작성자 : <?php echo $view[2] ?><br>
            작성일자 : <?php echo $view[6] ?><br>
        <div class="post_contents"><?php echo $view[4] ?></div>
<hr>
<?php
echo "<input type='button' value='목록' class=\"btn btn-info\" onclick='Go_post()'>";
echo "<input type='button' value='수정' class=\"btn btn-success\" onclick='location.href=\"listup.php?\"+\"mod_page=\"+$view[0]'>";
echo "<input type='button' value='삭제' class=\"btn btn-danger\" onclick='location.href=\"board_list_up.php?\"+\"del_page=\"+$view[0]'>";
echo "<br>";
?>

        </div>

<table class="table table-striped">
<tr>
    <?php
    $re_query = "select * from board where board_pid='$view[0]'";
    $query_select = mysql_query($re_query);
    $re_rows = mysql_num_rows($query_select);
    for($i=0;$i<$re_rows;$i++){
        $re_viwe = mysql_fetch_array($query_select);
        echo "<tr><td class='td_A'>$re_viwe[2]</td>";
        echo "<td rowspan='2' class='td_B'>&nbsp&nbsp$re_viwe[4]</td>";
        echo "<td><button class=\"btn btn-primary\" onclick=mod_re($re_viwe[0],$re_viwe[1])>수정</button></td></tr>";
        echo "<tr ><td class='td_A'>$re_viwe[6]</td>";
        echo "<td >";
        echo "<button class=\"btn btn-danger\" onclick=del_re($re_viwe[0],$re_viwe[1])>삭제";
        echo "</button></td></tr>";
    }
    ?>
    <form action="board_list_up.php" method="post" class="form-horizontal">

    <td>
        <?php echo "<input type='hidden' value='$view[0]' name='re_id'>"?>
        <input type="text" name="re">
    </td>
    <td>
        <input type="submit" class="btn btn-default" value="댓글작성">
    </td>
    </form>
</tr>
</table>

    </div>
<script>
    function Go_post(num) {
        location.href = "board_list.php";
    }
    function mod_re(re_id,re_pid) {
        var mod_re = prompt("수정 내용을 입력하시오");
        alert(re_pid);
        location.href = "board_list_up.php?mod_re="+mod_re+"&"+"rre_id="+re_id+"&"+"re_pid="+re_pid;
    }
    function del_re(re_id,re_pid) {
        var del_re = "del";
        location.href = "board_list_up.php?del_re="+del_re+"&"+"rre_id="+re_id+"&"+"re_pid="+re_pid;
    }
</script>
</div>