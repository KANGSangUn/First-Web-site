<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
    .form-control{
        width: 50%;
    }

</style>
<div class="modal-header">
    <h4 class="modal-title">글작성</h4>
</div>
<div class="modal-body">
    <div class="list">
        <form method="post" action="board_list_up.php"><br>
            <input type="text" name="subject" class="form-control" value="제목을 입력하세요" style="width:100%;"  onfocus="this.value=''"><hr><br>
            <textarea name="content" class="form-control" style="height: 300px; width:100%;"  onfocus="this.value=''">내용을 입력하세요
                </textarea><br>
            <?php
            session_start();
            if(@$_SESSION['id']==null){
                echo "<script>alert('로그인 후 이용 가능합니다');location.href = 'board_list.php';</script>";
            }else {
                $mod_page = isset($_GET['mod_page']) ? $_GET['mod_page'] : null;
                if ($mod_page != null) {
                    echo "<input type='hidden' value='$mod_page' name='mod'>";
                }
            }
            ?>
            <input type="submit" value="작성완료" class="btn btn-success">
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="location='board_list.php'">닫기</button>
</div>


