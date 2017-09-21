<html>
<meta charset="UTF-8">
<title>어여들어와라. 춥다</title>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(function(){
        $("#popbutton").click(function(){
            $('div.modal').modal({remote : 'listup.php'});
        })
    })

</script>

<style>
    .all {
        width: 70%;
        height: 70%;
        margin: 40px auto;
    }

    .page_css {
        position: absolute;
        left: 0;
        top: 70%;
        width: 100%;
        text-align: center;
        font-size: 15px;
    }
    .table {
        text-align: center;
        font-family: "맑은 고딕";
    }
    .board_list {
        background-color: #d7eae8;
    }
    .title_board {
        color: #67b168;
    }
</style>


<div class="all">
<h1 class="title_board">상운이의 본심이 담겨있는 게시판</h1>


    <table class="table table-bordered" >
    <tr class="board_list">
    <td>글번호</td><td>제목</td><td>작성자</td><td>조회수</td><td>작성시간</td>

<?php
session_start();
@$db_data = mysql_pconnect("localhost","root","gofla56",true);
mysql_select_db("ksu_test",$db_data);
$this_page = isset($_GET['this_page']) ? $_GET['this_page'] : 0;

$con = isset($_GET['con']) ? $_GET['con'] : null;
$select_text = isset($_GET['select_text']) ? $_GET['select_text'] : null;



$page_querys = "select * from board where board_pid=0";
$page_where = "select * from board where board_pid=0 AND ".$con." LIKE '%".$select_text."'";

/*-------------------------------------*/
/*페이지네이션 부분*/

    $page_count = 10;

    if($con!=null && $con!="all_con") {
        $page_query=$page_where;

    }else if($con=="all_con"){
        $page_query="select * from board where board_pid=0 AND (user_id LIKE '%".$select_text."%' AND board_pid=0) OR (subject LIKE '%".$select_text."%' AND board_pid=0) OR (contents LIKE '%".$select_text."%' AND board_pid=0)";
    }
    else {
        $page_query = $page_querys;
    }
    $page_output = mysql_query($page_query);
    $p_total_page = mysql_num_rows($page_output);
    $p_total_page_num = floor($p_total_page / $page_count);
    if ($p_total_page % $page_count > 0) {
        $p_total_page_num++;
    }

    /*-------------------------------------*/
if($con!=null && $con!="all_con") {
    $query="select * from board where board_pid=0 AND ".$con." LIKE '%".$select_text."'ORDER by board_id DESC limit $this_page,10";
}
else if($con=="all_con") {
    $query="select * from board where board_pid=0 AND (user_id LIKE '%".$select_text."%' AND board_pid=0) OR (subject LIKE '%".$select_text."%' AND board_pid=0) OR (contents LIKE '%".$select_text."%' AND board_pid=0) ORDER by board_id DESC limit $this_page,10";
}
else{
    $query ="select * from board where board_pid=0 ORDER by board_id DESC limit $this_page,10";
}

    $output = mysql_query($query);
    $total_page = mysql_num_rows($output);

    for ($i = 0; $i < $total_page; $i++) {
        $re_array = mysql_fetch_array($output);
        echo "<tr>";
        echo "<td>$re_array[0]</td>";
        echo "<td onclick='location.href = \"board_post.php?\"+\"this_post=\"+$re_array[0];'>$re_array[3]</td>";
        echo "<td>$re_array[2]</td>";
        echo "<td>$re_array[5]</td>";
        echo "<td>$re_array[6]</td>";
        echo "</tr>";
    }



?>  <?php
        if(@$_SESSION['id']!=null)
            echo $_SESSION['id']."님으로 접속중입니다.";
        else
            echo "GUEST 로 접속중입니다."
        ?>
    </tr>
</table >

<div class="page_css">
<ul class="pagination pagination-lg">
    <nav>
        <ul class="pagination">
            <?php
            $p1 = $this_page/10-2;
            $p2 = $this_page/10-1;
            $p3 = $this_page/10-0;
            $p4 = $this_page/10+1;
            $p5 = $this_page/10+2;
            if($p3<=0){
                echo "<li><a onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+0;' aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
            }else
            echo "<li><a onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p2*10;' aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
            if($p_total_page_num>=5 && $this_page>30) {
                echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p1*10;'>$p1</a></li>";
                echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p2*10;'>$p2</a></li>";
                echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p3*10;'>$p3</a></li>";
                if($p4<$p_total_page_num)
                    echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p4*10;'>$p4</a></li>";
                if($p5<$p_total_page_num)
                    echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$p5*10;'>$p5</a></li>";

            }else if($p_total_page_num>=5)
            {
                for($pp1=0;$pp1<5;$pp1++){
                    $pp2 = $pp1+1;
                    echo " <li><a aria-label=\"Previous\" onclick='location.href=\"board_list.php?\"+\"con=\"+\"$con&\"+\"select_text=\"+\"$select_text&\"+\"this_page=\"+$pp1*10;'>$pp2</a></li>";
                }
            }
            if($p3>=$p_total_page_num){
                echo "<li><a onclick='location.href=\"board_list.php?\"+\"con = \"+\"$con & \"+\"select_text = \"+\"$select_text&\"+\"this_page=\"+$p3*10;' aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
            }else
            echo "<li><a onclick='location.href=\"board_list.php?\"+\"con = \"+\"$con & \"+\"select_text = \"+\"$select_text&\"+\"this_page=\"+$p4*10;' aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
            ?>
        </ul>
    </nav>
<br>
    <button id="popbutton">글 작성</button>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

<?php
echo "<button onclick=location.href=\"loginout.php?\"+\"logout=\"+'out';>로그아웃</button>&nbsp;";
?>

</div>

<form action="board_list.php" method="get">
<select name="con" class="form-control" style="width:200px;">
    <option value="subject">제목</option>
    <option value="user_id">작성자</option>
    <option value="contents">내용</option>
    <option value="all_con">전체검색</option>
    <input type="text" name="select_text"><input type="submit" value="검색">
</select>
</div>
</form>

</html>



