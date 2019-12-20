<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Halaman Register</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- =======================================================
      Theme Name: NiceAdmin
      Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body class="login-img3-body">
  <div class="container">
    <h2 class="text-center">Aplikasi Perhitungan Zakat Harta</h2>
    <?php if(!empty($message)):?>
    <div class="row">
      <div class="alert alert-<?=$status?> fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <?=$message?>
      </div>
    </div>
    <?php endif?>
    <form class="login-form" action="register_action.php" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_key_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" autofocus required>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_mail"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_archive"></i></span>
          <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
        </div>
        <button class="btn btn-info btn-lg btn-block" type="submit">Daftar</button>
      </div>
    </form>
  </div>


</body>

</html>
