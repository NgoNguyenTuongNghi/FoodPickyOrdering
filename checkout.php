<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
        if ($_POST['submit']) {
            $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";
            mysqli_query($db, $SQL);
            $success = "Cảm ơn! Bạn đã đặt món thành công!";
        }
    }
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Thủ tục thanh toán</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="site-wrapper">
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
                                        echo '  <li class="nav-item"><a href="login.php" class="nav-link active">Đăng nhập</a> </li>
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
                                <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Chọn cửa hàng</a></li>
                                <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Chọn món</a></li>
                                <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Đặt hàng và thanh toán</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="container">
                        <span style="color:green;">
                            <?php echo $success; ?>
                        </span>
                    </div>

                    <div class="container m-t-30">
                        <form action="" method="post">
                            <div class="widget clearfix">
                                <div class="widget-body">
                                    <form method="post" action="#">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="cart-totals margin-b-20">
                                                    <div class="cart-totals-title">
                                                        <h4>Tóm tắt giỏ hàng</h4>
                                                    </div>
                                                    <div class="cart-totals-fields">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tổng cộng</td>
                                                                    <td> <?php echo $item_total . "k"; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Phí vận chuyển</td>
                                                                    <td>Miễn phí vận chuyển</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-color"><strong>Thành tiền</strong></td>
                                                                    <td class="text-color"><strong> <?php echo $item_total . "k"; ?></strong></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="payment-option">
                                                    <ul class=" list-unstyled">
                                                        <li>
                                                            <label class="custom-control custom-radio  m-b-20">
                                                                <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thanh toán khi nhận hàng</span>
                                                                <br> <span>Thanh toán COD khi nhận hàng.</span> </label>
                                                        </li>
                                                        <li>
                                                            <label class="custom-control custom-radio  m-b-10">
                                                                <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thẻ <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                                        </li>
                                                    </ul>
                                                    <p class="text-xs-center"> <input type="submit" onclick="return confirm('Bạn có chắc chắn?');" name="submit" class="btn btn-outline-success btn-block" value="Đặt hàng ngay"> </p>
                                                </div>
                                    </form>
                                </div>
                            </div>

                    </div>
                </div>
                </form>
            </div>
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
                            <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo" style="width: 44px; "> </a> <span>Ứng dụng đặt và giao món FoodPicky </span> </div>
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
        </div>
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