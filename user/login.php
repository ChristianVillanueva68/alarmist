<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php require_once('inc/header.php') ?>
    <?php if($_settings->chk_flashdata('success')): ?>
    <script>
      alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
    </script>
    <?php endif;?>      
  <script>
    start_loader()
  </script>
  </head>
  <style>

     html, body{
        width:100%;
        height:100% !important;
    }
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: contrast(1);
    }

.titlelogo {
    width: 100px;
    height: 100px;
}

.logintitle {
    font-size: 3.5rem;
}

.login-box {
    height: 75vh;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

@media (min-width: 768px) {
    .titlelogo {
        width: 150px;
        height: 150px;
    }

    .logintitle {
        font-size: 5rem;
    }

    .login-box {
        height: 80vh;
    }
     .btn-primary {
        width: 100px;
    }
    
}

  </style>
  <body class="hold-transition login-page newbg">
  <img src="<?php echo validate_image($_settings->info('logo')) ?>" class="my-lg-2 d-inline-block align-top titlelogo" alt="" loading="lazy">
  <h1 class="text-center text-white logintitle px-4"><b>Alarmist</b></h1>
  <div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
        <div class="card card-navy my-2">
          <div class="card-body">
            <p class="login-box-msg">Enter your username and password</p>
            <form id="ulogin-frm" action="" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="email" autofocus placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-8">
                  <a href="./register.php" class="register-link">Create an Account</a>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url ?>dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
    $('#ulogin-frm').submit(function(e) {
        e.preventDefault()
        start_loader()
        if ($('.err_msg').length > 0)
            $('.err_msg').remove()
        $.ajax({
            url: _base_url_ + 'classes/Login.php?f=user_login',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)

            },
            success: function(resp) {
                if (resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 'success') {
                        location.replace(_base_url_ + 'user');
                    } else if (resp.status == 'incorrect') {
                        var _frm = $('#ulogin-frm')
                        var _msg = "<div class='alert alert-danger err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>"
                        _frm.prepend(_msg)
                        _frm.find('input').addClass('is-invalid')
                        $('[name="username"]').focus()
                    }
                    end_loader()
                }
            }
        })
    })
  })
</script>
</body>
</html>