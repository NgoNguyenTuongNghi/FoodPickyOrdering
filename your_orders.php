<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Đặt hàng</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <style type="text/css" rel="stylesheet">
            .indent-small {
                margin-left: 5px;
            }

            .form-group.internal {
                margin-bottom: 0;
            }

            .dialog-panel {
                margin: 10px;
            }

            .datepicker-dropdown {
                z-index: 200 !important;
            }

            .panel-body {
                background: #e5e5e5;
                background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
                background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
                font: 600 15px "Open Sans", Arial, sans-serif;
            }

            label.control-label {
                font-weight: 600;
                color: #777;
            }

            table {
                width: 750px;
                border-collapse: collapse;
                margin: auto;

            }

            tr:nth-of-type(odd) {
                background: #eee;
            }

            th {
                background: #ff3300;
                color: white;
                font-weight: bold;
            }

            td,
            th {
                padding: 10px;
                border: 1px solid #ccc;
                text-align: left;
                font-size: 14px;

            }

            @media only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px) {

                table {
                    width: 100%;
                }

                table,
                thead,
                tbody,
                th,
                td,
                tr {
                    display: block;
                }

                thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr {
                    border: 1px solid #ccc;
                }

                td {
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }

                td:before {
                    position: absolute;
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                    content: attr(data-column);
                    color: #000;
                    font-weight: bold;
                }
            }
        </style>

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
                            <div class="col-xs-12 col-sm-7 col-md-7 ">
                                <div class="bg-gray restaurant-entry">
                                    <div class="row">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Món</th>
                                                    <th>Số lưỢng</th>
                                                    <th>Giá</th>
                                                    <th>Tình trạng</th>
                                                    <th>Thời gian</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                                if (!mysqli_num_rows($query_res) > 0) {
                                                    echo '<td colspan="6"><center>Bạn chưa đặt món </center></td>';
                                                } else {
                                                    while ($row = mysqli_fetch_array($query_res)) {

                                                ?>
                                                        <tr>
                                                            <td data-column="Item"> <?php echo $row['title']; ?></td>
                                                            <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                                            <td data-column="price"><?php echo $row['price']; ?>k</td>
                                                            <td data-column="status">
                                                                <?php
                                                                $status = $row['status'];
                                                                if ($status == "" or $status == "NULL") {
                                                                ?>
                                                                    <button type="button" class="btn btn-info" style="font-weight:bold;">Đã giao!</button>
                                                                <?php
                                                                }
                                                                if ($status == "in process") { ?>
                                                                    <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>Đang giao!</button>
                                                                <?php
                                                                }
                                                                if ($status == "closed") {
                                                                ?>
                                                                    <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Đang tiếp nhận!</button>
                                                                <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($status == "rejected") {
                                                                ?>
                                                                    <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>Hủy đơn!</button>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td data-column="Date"> <?php echo $row['date']; ?></td>
                                                            <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Bạn có chắc là muốn hủy đơn?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
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
<?php
}
?>