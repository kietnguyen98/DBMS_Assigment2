<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/login.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<?php include('../Server/editorServer.php'); ?>

<body>
    <div>
        <?php include_once('component/header.php');?>
    </div>
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="display-4 text-center text-info text-uppercase">Danh sách các bài báo hiện nay</div>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col">Tác giả liên lạc</th>
                    <th class="text-center" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($select_all_paper_result as $paper){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$paper['paper_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php echo $paper['title']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($paper['post_date']));?>
                    </td>
                    <td>
                        <?php 
                            $author_id = $paper['contact_author_id'];
                            $get_author_name_query = "select last_name, middle_name, first_name from scientist where id = '$author_id'";
                            $get_author_name_result = mysqli_query($connect_handle, $get_author_name_query);
                            $data = mysqli_fetch_assoc($get_author_name_result);
                            echo $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                        ?>
                    </td>
                    <td class="text-center">
                        <form class="option" method="POST" action="editorHomePage.php">
                            <input type="hidden" name="paperId" value="<?php echo $paper['paper_id'];?>" />
                            <button class="btn btn-success" name="getMoreInfoBtn">Xem chi tiết</button>
                            <button class="btn btn-primary" name="updateReivewer">Cập nhật phản biện</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="modal fade" id="moreinfo-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mã Bài báo:
                            <?php echo $moreinfo_paper_data['paper_id'] ?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tiêu đề :</strong>
                            <?php 
                            $papertitle = $moreinfo_paper_data['title'];
                            if($papertitle != NULL){
                                echo $papertitle;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                            ?>
                        </p>
                        <p><strong>Tóm tắt :</strong>
                            <?php 
                            $papersummary = $moreinfo_paper_data['summary'];
                            if($papersummary != NULL){
                                echo $papersummary;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Link bài báo :</strong>
                            <?php 
                            $paperfile = $moreinfo_paper_data['paper_file'];
                            if($paperfile != NULL){
                                echo "<a href=".$paperfile.">".$paperfile."</a>";
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Tác giả liên lạc :</strong>
                            <?php 
                            $author_id = $moreinfo_paper_data['contact_author_id'];
                            $get_author_name_query = "select last_name, middle_name, first_name from scientist where id = '$author_id'";
                            $get_author_name_result = mysqli_query($connect_handle, $get_author_name_query);
                            $data = mysqli_fetch_assoc($get_author_name_result);
                            $paperauthorname = $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
                            if($paperauthorname != NULL){
                                echo $paperauthorname;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ngày đăng :</strong>
                            <?php 
                            $paperpostdate = $moreinfo_paper_data['post_date'];
                            if($paperpostdate != NULL){
                                echo date('d/m/Y', strtotime($paperpostdate));
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Tình trạng :</strong>
                            <?php 
                            $paperstatus = $moreinfo_paper_data['status'];
                            if($paperstatus != NULL){
                                echo $paperstatus;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Kết quả sau phản biện :</strong>
                            <?php 
                            $paperafterreviewresult = $moreinfo_paper_data['after_review_result'];
                            if($paperafterreviewresult != NULL){
                                echo $paperafterreviewresult;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Kết quả cuối cùng :</strong>
                            <?php 
                            $paperfinalresult = $moreinfo_paper_data['final_result'];
                            if($paperfinalresult != NULL){
                                echo $paperfinalresult;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Ngày công bố :</strong>
                            <?php 
                            $paperannouncedate = $moreinfo_paper_data['announce_date'];
                            if($paperannouncedate != NULL){
                                echo date('d/m/Y', strtotime($paperannouncedate));
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                        <p><strong>Người biên tập :</strong>
                            <?php
                            $editor_id = $moreinfo_paper_data['editor_id'];
                            $get_editor_name_query = "select last_name, middle_name, first_name from scientist where id = '$editor_id'";
                            $get_editor_name_result = mysqli_query($connect_handle, $get_editor_name_query);
                            $data = mysqli_fetch_assoc($get_editor_name_result);
                            $editorname = $data['last_name']." ".$data['middle_name']." ".$data['first_name']; 
                            if($editorname != NULL){
                                echo $editorname;
                            }else{
                                echo '<i class="text-muted">Chưa có thông tin</i>';
                            }
                        ?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="editorHomePage.php">
                            <input type="hidden" name="paperIdToUpdate"
                                value="<?php echo $moreinfo_paper_data['paper_id']; ?>" />
                            <button type="submit" class="btn btn-success" name="updatePaper">Cập nhật</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật cho bài báo :
                            <?php echo $paperIdToUpdate ;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-container" name="updateForm" method="POST" action="editorHomePage.php">
                            <div class="form-group">
                                <label for="status"><strong>Tình trạng</strong></label>
                                <select class="custom-select" name="status">
                                    <option value="in review">in review</option>
                                    <option value="response review">response review</option>
                                    <option value="complete review">complete review</option>
                                    <option value="publishing">publishing</option>
                                    <option value="posted">posted</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="after_review_result"><strong>Kết quả sau phản biện</strong></label>
                                <select class="custom-select" name="after_review_result">
                                    <option value="Very Good">Very Good</option>
                                    <option value="Good">Good</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Bad">Bad</option>
                                    <option value="Very Bad">Very Bad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="final_result"><strong>Kết quả cuối cùng</strong></label>
                                <select class="custom-select" name="final_result">
                                    <option value="major revision">major revision</option>
                                    <option value="acceptance">acceptance</option>
                                    <option value="minor revision">minor revision</option>
                                    <option value="rejection">rejection</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="paperIdToUpdate" value="<?php echo $paperIdToUpdate ;?>" />
                                <button type="submit" class="btn btn-success" name="updateBtn">Lưu thông tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-success-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cập nhật</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-left text-success"><strong>
                                Cập nhật thông tin thành công !
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-review-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật phản biện cho bài báo :
                            <?php echo $paperId ;?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <strong>Danh sách người phản biện hiện tại: </strong>
                        <?php if(mysqli_num_rows($reviewer_data) > 0): ?>
                        <?php foreach($reviewer_data as $reviewer):?>
                        <p class="text-left">
                            <?php echo $reviewer['last_name'].' '.$reviewer['middle_name'].' '.$reviewer['first_name']; ?>
                        </p>
                        <?php endforeach ?>
                        <?php else: ?>
                        <?php echo '<p><i class="text-left text-muted">Chưa có người phản biện</i></p>'; ?>
                        <?php endif ?>
                        <form class="form-container" name="updateReviewerForm" method="POST" action="editorHomePage.php">
                            <div class="form-group">
                                <label for="status"><strong>Thêm người phản biện</strong></label>
                                <select class="custom-select" name="reviewer">
                                    <?php foreach($all_reviewer_data as $reviewer):?>
                                    <option value="<?php echo $reviewer['id'] ?>">
                                        <?php echo $reviewer['last_name'].' '.$reviewer['middle_name'].' '.$reviewer['first_name'];?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <br>
                            <div class="text-right">
                                <input type="hidden" name="paperId" value="<?php echo $paperId ;?>" />
                                <button type="submit" class="btn btn-success" name="updateReviewerBtn">Lưu thông
                                    tin</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="count-return-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark text-uppercase">
                        <strong><?php echo $result_text; ?></strong>
                    </div> 
                    <div class="modal-body">
                        <h5 class="modal-title text-info">Kết quả: <?php 
                            $count = mysqli_fetch_assoc($result_count);
                            echo $count['Sum'];
                        ?></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="display-4 text-center text-info text-uppercase" style="padding-top: 40px;">Danh sách các bài báo
            theo lựa chọn</div>
        <hr>
        <form class="form-container" name="viewOption" method="POST" action="editorHomePage.php">
            <label for="viewOption"><strong>chọn tính năng hiển thị</strong></label>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <select class="custom-select" name="optionView">
                        <option value="5">Xem danh sách các bài báo theo mỗi loại (nghiên cứu, phản biện sách, tổng
                            quan) chưa được xử lý phản biện</option>
                        <option value="6">Xem danh sách các bài báo theo mỗi loại (nghiên cứu, phản biện sách, tổng
                            quan) được xuất bản</option>
                        <option value="7">Xem danh sách các bài báo đã đăng theo mỗi loại (nghiên cứu, phản biện sách,
                            tổng quan) trong 3 năm gần nhất</option>
                        <option value="8">Xem danh sách các bài báo được xuất bản của một tác giả</option>
                        <option value="9">Xem danh sách các bài báo đã đăng của một tác giả</option>
                        <option value="10">Xem tổng số bài báo đang được phản biện</option>
                        <option value="11">Xem tổng số bài báo đang được phản hồi phản biện</option>
                        <option value="12">Xem tổng số bài báo đang được xuất bản</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select class="custom-select" name="authorid">
                        <?php 
                            $query_author="select id, last_name, middle_name, first_name from scientist where scientist.id in (select id from author)";
                            $result_author = mysqli_query($connect_handle, $query_author);
                        ?>
                        <?php foreach($result_author as $author):?>
                            <option value="<?php echo $author['id']?>"><?php echo $author['last_name'].' '.$author['middle_name'].' '.$author['first_name'];?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group text-right col-md-1">
                    <button type="submit" class="btn btn-success" name="viewOption">Hiển thị</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mã DOI</th>
                    <th scope="col">Thể loại</th>
                </tr>
            </thead>
            <tbody>
                <?php if($get_option_result != NULL):?>
                <?php foreach ($get_option_result as $paper){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>'.$paper['paper_id'].'</strong>'; ?>
                    </td>
                    <td>
                        <?php echo $paper['title']; ?>
                    </td>
                    <td>
                        <?php
                            if(array_key_exists('DOI',$paper)){
                                echo $paper['DOI'];
                            }else{
                                echo "Null";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(array_key_exists('Category',$paper)){
                            echo $paper['Category'];
                        }else{
                            echo "Null";
                        } 
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>