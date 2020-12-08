<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

include_once 'product-action.php';

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Món</title>
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
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Nhà hàng <span class="sr-only"></span></a> </li>
                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng nhập</a> </li>
							        <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng ký</a> </li>';
                            }
                            else {
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
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Chọn nhà hàng</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Chọn món bạn ưa thích</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Đặt hàng và thanh toán</a></li>
                    </ul>
                </div>
            </div>
            <?php $ress = mysqli_query($db, "select * from restaurant where rs_id='$_GET[res_id]'");
            $rows = mysqli_fetch_array($ress);
            ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/dish.jpeg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    <ul class="nav nav-inline">
                                        <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Tối thiểu 70k</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 15 phút</a> </li>
                                        <li class="nav-item ratings">
                                            <a class="nav-link" href="#"> <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="breadcrumb">
                <div class="container">
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        <div class="widget widget-cart">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Giỏ hàng của bạn
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="order-row bg-white">
                                <div class="widget-body">
                                    <?php
                                    $item_total = 0;
                                    foreach ($_SESSION["cart_item"] as $item)
                                    {
                                    ?>
                                        <div class="title-row">
                                            <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                                <i class="fa fa-trash pull-right"></i></a>
                                        </div>
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control b-r-0" value=<?php echo $item["price"] . "k"; ?> readonly id="exampleSelect1">
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        </div>
                                    <?php
                                        $item_total += ($item["price"] * $item["quantity"]);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="price-wrap text-xs-center">
                                    <p>THÀNH TIỀN</p>
                                    <h3 class="value"><strong><?php echo $item_total . "k"; ?></strong></h3>
                                    <p>Miễn phí vận chuyển</p>
                                    <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check" class="btn theme-btn btn-lg">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    ĐƠN ĐẶT PHỔ BIẾN món ngon nổi bật! <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
                                <?php
                                $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                                $stmt->execute();
                                $products = $stmt->get_result();
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                                ?>
                                        <div class="food-item">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                                    <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                        <div class="rest-logo pull-left">
                                                            <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/' . $product['img'] . '" alt="Food logo">'; ?></a>
                                                        </div>
                                                        <div class="rest-descr">
                                                            <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                            <p> <?php echo $product['slogan']; ?></p>
                                                        </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                                    <span class="price pull-left"><?php echo $product['price']; ?>k</span>
                                                    <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                                    <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Thêm món" />
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
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
                                                Coupons
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Khuyến mãi
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Giảm giá
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Momo
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Viettel Pay
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Thời trang
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Quần áo
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Trẻ em
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Du lịch
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Hosting
                                            </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">72.000 đ</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">60.000 đ</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">48.000 đ</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">75.000 đ</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn theme-btn">Thêm vào giỏ hàng</button>
                </div>
            </div>
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