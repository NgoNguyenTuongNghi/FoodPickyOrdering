<!DOCTYPE html>
<html lang="en">
<?php

session_start();
error_reporting(0);
include("connection/connect.php");
if (isset($_POST['submit'])) {
   if (
      empty($_POST['firstname']) ||
      empty($_POST['lastname']) ||
      empty($_POST['email']) ||
      empty($_POST['phone']) ||
      empty($_POST['password']) ||
      empty($_POST['cpassword']) ||
      empty($_POST['cpassword'])
   ) {
      $message = "Nhập đủ cho các trường!";
   } else {
      $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
      $check_email = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

      if ($_POST['password'] != $_POST['cpassword']) {
         $message = "Mật khẩu không khớp";
      } elseif (strlen($_POST['password']) < 6) {
         $message = "Mật khẩu nên có độ dài >=6";
      } elseif (strlen($_POST['phone']) < 10) {
         $message = "Số điện thoại không đúng";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         $message = "Địa chỉ email không hợp lệ";
      } elseif (mysqli_num_rows($check_username) > 0)  //check username
      {
         $message = 'Tên đăng nhập đã tồn tại';
      } elseif (mysqli_num_rows($check_email) > 0) //check email
      {
         $message = 'Địa chỉ email đã được đăng ký';
      } else {
         $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "','" . $_POST['address'] . "')";
         mysqli_query($db, $mql);
         $success = "Tài khoản được đăng ký thành công! <p>Bạn sẽ được chuyển hướng trong <span id='counter'>5</span> giây(s).</p>
            <script type='text/javascript'>
            function countdown() {
               var i = document.getElementById('counter');
               if (parseInt(i.innerHTML)<=0) {
                  location.href = 'login.php';
               }
               i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },1000);
            </script>'";
         header("refresh:5;url=login.php");
      }
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
   <title>Đăng ký</title>
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
         <div class="breadcrumb">
            <div class="container">
               <ul>
                  <li><a href="#" class="active">
                        <span style="color:red;"><?php echo $message; ?></span>
                        <span style="color:green;">
                           <?php echo $success; ?>
                        </span>
                     </a></li>
               </ul>
            </div>
         </div>
         <section class="contact-page inner-page">
            <div class="container">
               <div class="row">
                  <div class="col-md-8">
                     <div class="widget">
                        <div class="widget-body">
                           <form action="" method="post">
                              <div class="row">
                                 <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Tên đăng nhập:</label>
                                    <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Tên đăng nhập">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Họ và chữ lót:</label>
                                    <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="Họ và chữ lót">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Tên:</label>
                                    <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Tên">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Địa chỉ email:</label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Địa chi email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Số điện thoại:</label>
                                    <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Số điện thoại"> <small class="form-text text-muted">We"ll never share your email with anyone else.</small>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Mật khẩu:</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Mật khẩu">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Xác nhận mật khẩu:</label>
                                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Xác nhận mật khẩu">
                                 </div>
                                 <div class="form-group col-sm-12">
                                    <label for="exampleTextarea">Địa chỉ giao hàng:</label>
                                    <textarea class="form-control" id="exampleTextarea" name="Địa chỉ" rows="3"></textarea>
                                 </div>

                              </div>

                              <div class="row">
                                 <div class="col-sm-4">
                                    <p> <input type="submit" value="Đăng ký" name="submit" class="btn theme-btn"> </p>
                                 </div>
                              </div>
                           </form>

                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <h4>Đăng ký nhanh chóng, dễ dàng và miễn phí</h4>
                     <p>Sau khi đăng ký, bạn có thể:</p>
                     <hr>
                     <img src="http://placehold.it/400x300" alt="" class="img-fluid">
                     <p></p>
                     <div class="panel">
                        <div class="panel-heading">
                           <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle collapsed" href="#faq1" aria-expanded="false"><i class="ti-info-alt" aria-hidden="true"></i>Giá bán món ăn trên FoodPicky có mắc hơn so với tại cửa hàng?</a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="faq1" aria-expanded="false" role="article" style="height: 0px;">
                           <div class="panel-body"> Nhiều người vẫn giữ nguyên giá kể cả khi bán trên FoodPicky hay tại quán, họ chấp nhận mức chiết khấu lời ít hơn nhưng bù lại lượng đơn hàng nhiều. Nói chung có món có thể bán giá trên FoodPicky cao hơn tí so với ăn tại quán tuy nhiên cao quá thì sẽ không ai ăn đâu nên họ đã phải tính toán kĩ coi chi phí lợi nhuận khi đã trừ chiết khấu. Đồng thời khi là nhân viên Thi Đà, bạn đã được giảm giá 20% theo phúc lợi của công ty. </div>
                        </div>
                     </div>
                     <div class="panel">
                        <div class="panel-heading">
                           <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle" href="#faq2" aria-expanded="true"><i class="ti-info-alt" aria-hidden="true"></i>Dùng FoodPicky có lợi ích gì?</a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="faq2" aria-expanded="true" role="article">
                           <div class="panel-body"> Có những ngày thời tiết thay đổi, mưa nắng thất thường, hoặc cơ thể bạn thực sự mệt mỏi khiến cho bạn cảm thấy không muốn đi ra ngoài, nhưng bụng của bạn lại trong tình trạng đói cồn cào. Với FoodPicky, bạn sẽ không còn lo ngại mỗi khi bụng đói nữa. Chỉ cần đặt món và đợi 15 phút, thứ bạn muốn sẽ ở trước mặt bạn. </div>
                        </div>
                     </div>
                     <h4 class="m-t-20">Liên hệ chăm sóc khách hàng</h4>
                     <p> Nếu bạn đang tìm kiếm thêm trợ giúp hoặc có câu hỏi cần hỏi, vui lòng </p>
                     <p> <a href="contact.html" class="btn theme-btn m-t-15">liên hệ chúng tôi</a> </p>
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