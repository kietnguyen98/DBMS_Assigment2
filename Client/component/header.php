<!DOCTYPE html>
<html lang="vi">
<?php include('../Server/userLogin.php'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="header">
    <meta name="author" content="team 20">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav" style="margin-right: auto;">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../homepage/index.php"><strong>Trang chủ</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../AboutUs/index.php"><strong>Giới thiệu</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../ServiceInfomation/index.php"><strong>Thông tin
                                dịch
                                vụ</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../Contact/index.php"><strong>Liên hệ</strong></a>
                    </li>
                </ul>
                <div class="input-group col-md-3" style="margin-left: auto;">
                    <input class="form-control py-2 border-right-0 border" type="search" placeholder="Tìm kiếm...">
                    <span class="input-group-append">
                        <button class="btn btn-success border-left-0" type="submit"><i
                                class="fas fa-search"></i></button>
                    </span>
                </div>
                <?php if(isset($_SESSION['username'])): ?>
                <div class="nav-item dropdown">
                    <a class="text-light nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <strong>
                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username']; ?>
                        </strong></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../UserInfo/index.php"><i class="fas fa-user-circle"></i> Thông tin cá nhân</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../index.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng
                            xuất</a>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </nav>
    </header>
</body>

</html>