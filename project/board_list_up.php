<?php
@$db_board = mysql_pconnect("localhost","root","gofla56",true);
mysql_select_db("ksu_test",$db_board);
//db연결
session_start();
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$day = date("Y-m-d H:i:s");
$subject = isset($_POST['subject']) ? $_POST['subject'] : null;
$mod = isset($_POST['mod']) ? $_POST['mod'] : null;
$content = nl2br(isset($_POST['content']) ? $_POST['content'] : null);

/* 게시물 삭제&수정 *//////////////////////////////////////////
$del_page = isset($_GET['del_page']) ? $_GET['del_page'] : null;
$mod_re = isset($_GET['mod_re']) ? $_GET['mod_re'] : null;

/* 리플관련 변수 */////////////////////////////////////////////
$re = isset($_POST['re']) ? $_POST['re'] : null;
$re_id = isset($_POST['re_id']) ? $_POST['re_id'] : null;
$rre_id = isset($_GET['rre_id']) ? $_GET['rre_id'] : null;
$re_pid = isset($_GET['re_pid']) ? $_GET['re_pid'] : null;
$del_re = isset($_GET['del_re']) ? $_GET['del_re'] : null;
///////////////////////////////////////////////////////////////

//받은 값들을 넣어주기
session_start();
if(@$_SESSION['id']==null){
    echo "<script>alert('로그인 후 이용 가능합니다');history.back();</script>";

}else {
    if ($mod != null) { //게시물 수정
        board_mod();
    } else if ($del_page != null) { //게시물 삭제
        board_del();
    } else if ($re_id != null) { //리플 작성
        re_write();
    } else if ($mod_re != null) { //리플 수정
        re_mod();
    } else if ($del_re == "del") { //리플 삭제
        re_del();
    } else {
        board_write();
    }
}

function board_write(){
    global $id,$subject,$content,$day;
    $query = "insert into board (board_pid,user_id,subject,contents,reg_date) VALUES ('0','$id','$subject','$content','$day')";
    mysql_query($query);
    echo "<script>location.href = \"board_list.php\";</script>";
}
function board_mod(){
    global $subject,$content,$mod;
    $query = "update board set subject ='$subject', contents='$content' where board_id='$mod'";
    mysql_query($query);
    echo "<script>location.href = \"board_list.php\";</script>";
}
function board_del(){
    global $del_page;
    $query = "DELETE FROM board WHERE board_id= ".$del_page;
    mysql_query($query);
    echo "<script>location.href = \"board_list.php\";</script>";
}
function re_write(){
    global $re_id,$id,$re,$day;
    $query = "insert into board(board_pid,user_id,contents,reg_date) VALUES ('$re_id','$id','$re','$day')";
    mysql_query($query);
    echo "<script>location.href = \"board_post.php?this_post=\"+$re_id;</script>";

}
function re_del(){
    global $rre_id,$re_pid;
    $query = "DELETE FROM board WHERE board_id= ".$rre_id;
    mysql_query($query);
    echo "<script>location.href = \"board_post.php?this_post=\"+$re_pid;</script>";

}
function re_mod(){
    global $mod_re,$re_pid,$rre_id;
    $query = "update board set contents='$mod_re' where board_id='$rre_id' and board_pid='$re_pid'";
    mysql_query($query);
    echo "<script>location.href = \"board_post.php?this_post=\"+$re_pid;</script>";
}




?>
