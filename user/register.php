<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>
<body class="d-flex flex-column align-items-center justify-content-center">
  <script>
    start_loader()
  </script>
  <style>
    html, body {
      width: 100%;
      height: 100% !important;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    
    body {
      background-color: #fafafa;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    #page-title {
      text-shadow: 0px 2px 2px rgba(0, 0, 0, 0.4);
      font-size: 3.5em;
      color: #262626;
      background: transparent;
      margin-top: 2rem;
    }
    
    img#cimg {
      height: 5em;
      width: 5em;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #fff;
    }
    
    .card {
      max-width: 600px;
      margin-top: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: #fff;
      border-bottom: none;
      padding: 1rem;
    }
    
    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 0;
      color: #262626;
    }
    
    .card-body {
      background-color: #fff;
      border: none;
      padding: 1rem;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .form-control {
      border-radius: 8px;
    }
    
    .form-control-sm {
      height: 35px;
    }
    
    .btn-primary {
      border-radius: 8px;
      width: 100%;
      font-weight: bold;
    }
    
    .register-link {
      color: #00376b;
      font-weight: bold;
      text-decoration: none;
    }
    
    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
    
    #page-title {
      animation: fadeIn 1s ease-in-out;
    }
  </style>
  
  <h1 class="text-center px-4 py-5" id="page-title"><b>Alarmist</b></h1>
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Provide your account information</h4>
          </div>
          <div class="card-body">
            <form id="register-form" action="" method="post">
              <input type="hidden" name="id">
              <input type="hidden" name="type" value="3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="firstname" class="control-label">First Name</label>
                    <input type="text" class="form-control form-control-sm" required name="firstname" id="firstname">
                  </div>
                  <div class="form-group">
                    <label for="middlename" class="control-label">Middle Name</label>
                    <input type="text" class="form-control form-control-sm" name="middlename" id="middlename">
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="control-label">Last Name</label>
                    <input type="text" class="form-control form-control-sm" required name="lastname" id="lastname">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" class="form-control form-control-sm" required name="email" id="email">
                  </div>
                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <div class="input-group input-group-sm">
                      <input type="password" class="form-control form-control-sm" required name="password" id="password">
                      <button tabindex="-1" class="btn btn-outline-secondary btn-sm pass_view" type="button"><i class="fa fa-eye-slash"></i></button>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cpassword" class="control-label">Confirm Password</label>
                    <div class="input-group input-group-sm">
                      <input type="password" class="form-control form-control-sm" required id="cpassword">
                      <button tabindex="-1" class="btn btn-outline-secondary btn-sm pass_view" type="button"><i class="fa fa-eye-slash"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="control-label">Avatar</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group d-flex justify-content-center">
                    <img src="<?php echo validate_image('') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <a href="./" class="register-link">Already have an Account</a>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
              </div>
            </form>
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
    function displayImg(input, _this) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      } else {
        $('#cimg').attr('src', "<?php echo validate_image('') ?>");
      }
    }

    $(document).ready(function () {
      end_loader();
      $('.pass_view').click(function () {
        var input = $(this).siblings('input')
        var type = input.attr('type')
        if (type == 'password') {
          $(this).html('<i class="fa fa-eye"></i>')
          input.attr('type', 'text').focus()
        } else {
          $(this).html('<i class="fa fa-eye-slash"></i>')
          input.attr('type', 'password').focus()
        }
      })
      $('#register-form').submit(function (e) {
        e.preventDefault()
        var _this = $(this)
        var el = $('<div>')
        el.addClass('alert alert-danger err_msg')
        el.hide()
        $('.err_msg').remove()
        if ($('#password').val() != $('#cpassword').val()) {
          el.text('Password does not match')
          _this.prepend(el)
          el.show('slow')
          $('html, body').scrollTop(0)
          return false;
        }
        if (_this[0].checkValidity() == false) {
          _this[0].reportValidity();
          return false;
        }
        start_loader()
        $.ajax({
          url: _base_url_ + "classes/Users.php?f=registration",
          method: 'POST',
          type: 'POST',
          data: new FormData($(this)[0]),
          dataType: 'json',
          cache: false,
          processData: false,
          contentType: false,
          error: err => {
            console.log(err)
            alert('An error occurred')
            end_loader()
          },
          success: function (resp) {
            if (resp.status == 'success') {
              location.replace('./')
            } else if (!!resp.msg) {
              el.html(resp.msg)
              el.show('slow')
              _this.prepend(el)
              $('html, body').scrollTop(0)
            } else {
              alert('An error occurred')
              console.log(resp)
            }
            end_loader()
          }
        })
      })
    })
  </script>
</body>

</html>


<style>
  html,
  body {
    width: 100%;
    height: 100% !important;
  }

  body {
    background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
    background-size: cover;
    background-repeat: no-repeat;
    backdrop-filter: contrast(1);
  }

  #page-title {
    text-shadow: 6px 4px 7px black;
    font-size: 3.5em;
    color: #fff4f4 !important;
    background: #8080801c;
  }

  img#cimg {
    height: 5em;
    width: 5em;
    object-fit: cover;
    border-radius: 100% 100%;
  }

  .card {
    max-width: 600px;
    margin-top: 2rem;
  }

  .card-header {
    background-color: #fafafa;
  }

  .card-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 0;
  }

  .card-body {
    background-color: #fff;
    border: none;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-control {
    border-radius: 8px;
  }

  .form-control-sm {
    height: 35px;
  }

  .btn-primary {
    border-radius: 8px;
    width: 100%;
    font-weight: bold;
  }

  .register-link {
    color: #00376b;
    font-weight: bold;
    text-decoration: none;
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }

  #page-title {
    animation: fadeIn 1s ease-in-out;
  }

  .err_msg {
    animation: fadeIn 0.3s ease-in-out;
  }

  .err_msg.hide {
    display: none;
  }
</style>
