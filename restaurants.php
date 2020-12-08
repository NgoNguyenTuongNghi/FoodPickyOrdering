<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Cửa hàng</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt="" style="width: 44px;"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Trang chủ <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Cửa hàng <span class="sr-only"></span></a> </li>
                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng nhập</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng ký</a> </li>';
                            } else {
                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn đã đặt</a> </li>';
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Đăng xuất</a> </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                        <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Chọn cửa hàng</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Chọn món</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Đặt hàng và thanh toán</a></li>
                    </ul>
                </div>
            </div>
            <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
                <div class="container"> </div>
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                            <div class="widget clearfix">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                        Chủ đề phổ biến
                                    </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget-body">
                                    <ul class="tags">
                                        <li> <a href="#" class="tag">
                                                Pizza
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sandwich
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Trà sữa
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Ốc
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Cà phê
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Bún cá
                                            </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                            <div class="bg-gray restaurant-entry">
                                <div class="row">
                                    <?php $ress = mysqli_query($db, "select * from restaurant");
                                    while ($rows = mysqli_fetch_array($ress)) {
                                        echo ' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                                    <div class="entry-logo">
                                                        <a class="img-fluid" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="admin/Res_img/' . $rows['image'] . '" alt="Food logo"></a>
                                                    </div>
                                                    <div class="entry-dscr">
                                                        <h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> <span>' . $rows['address'] . ' <a href="#">...</a></span>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-check"></i> Tối thiểu 70k</li>
                                                            <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 15 phút</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                                        <div class="right-content bg-white">
                                                            <div class="right-review">
                                                                <div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                                                <p> 222 Đánh giá</p> <a href="dishes.php?res_id=' . $rows['rs_id'] . '" class="btn theme-btn-dash">Hiển thị menu</a> </div>
                                                        </div>
                                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <section class="app-section">
            <div class="app-wrap">
                <div class="container">
                    <div class="row text-img-block text-xs-left">
                        <div class="container">
                            <div class="col-xs-12 col-sm-6  right-image text-center">
                                <figure> <img src="images/app.png" alt="Right Image"> </figure>
                            </div>
                            <div class="col-xs-12 col-sm-6 left-text">
                                <h3>Ứng dụng đặt món tốt nhất</h3>
                                <p>Giờ đây, bạn có thể đặt mua đồ ăn ở bất cứ đâu nhờ ứng dụng đặt và giao món miễn phí, dễ sử dụng.</p>
                                <div class="social-btns">
                                    <a href="#" class="app-btn apple-button clearfix">
                                        <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                        <div class="pull-right"> <span class="text">Đã có mặt trên</span> <span class="text-2">App Store</span> </div>
                                    </a>
                                    <a href="#" class="app-btn android-button clearfix">
                                        <div class="pull-left"><i class="fa fa-android"></i> </div>
                                        <div class="pull-right"> <span class="text">Đã có mặt trên</span> <span class="text-2">Play store</span> </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <div class="row top-footer">
                    <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo" style="     width: 44px; "> </a> <span>Ứng dụng đặt và giao món </span> </div>
                    <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>Thông tin tác giả</h5>
                        <ul>
                            <li><a href="#">Thông tin</a> </li>
                            <li><a href="#">Lịch sử</a> </li>
                            <li><a href="#">Nhóm TNT</a> </li>
                            <li><a href="#">Tuyển dụng</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>Hướng dẫn sử dụng</h5>
                        <ul>
                            <li><a href="#">Vị trí giao</a> </li>
                            <li><a href="#">Chọn cửa hàng</a> </li>
                            <li><a href="#">Chọn món</a> </li>
                            <li><a href="#">Thanh toán</a> </li>
                            <li><a href="#">Giao hàng</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 pages color-gray">
                        <h5>Trang</h5>
                        <ul>
                            <li><a href="#">Trang tìm kiếm</a> </li>
                            <li><a href="#">Trang đăng nhập</a> </li>
                            <li><a href="#">Trang giá cả</a> </li>
                            <li><a href="#">Đặt hàng</a> </li>
                            <li><a href="#">Thêm món</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                        <h5>Xu hướng</h5>
                        <ul>
                            <li><a href="#">Bún cá</a> </li>
                            <li><a href="#">Bánh canh</a> </li>
                            <li><a href="#">Bánh căn</a> </li>
                            <li><a href="#">Bánh xèo chảo</a> </li>
                            <li><a href="#">Nem cuốn</a> </li>
                            <li><a href="#">Nem nướng</a> </li>
                            <li><a href="#">Bò nướng</a> </li>
                            <li><a href="#">Cháo hến</a> </li>
                            <li><a href="#">Bò lúc lắc</a> </li>
                            <li><a href="#">Ốc</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="row bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                <h5>Phương thức thanh toán</h5>
                                <ul>
                                    <li>
                                        <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-4 address color-gray">
                                <h5>Địa chỉ</h5>
                                <p>Thiết kế ý tưởng về đặt hàng và giao đồ ăn trực tuyến, tạo kế hoạch cho thực đơn nhà hàng</p>
                                <h5>Liên hệ: <a href="tel:+0869121907">0869 121 907</a></h5>
                            </div>
                            <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                <h5>Thông tin bổ sung</h5>
                                <p>Tham gia cùng hàng nghìn cửa hàng khác, những người được hưởng lợi từ việc đưa thực đơn của họ lên ứng dụng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>