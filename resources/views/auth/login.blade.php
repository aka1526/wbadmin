<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Document Control')</title>

    <!-- Bootstrap -->
    <link href="/asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/asset/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/asset/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/custom/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>

      <div class="login_wrapper">
        <div class="animate form ">
          <section class="login_content">
            <form id="form-login" name="form-login" action="{{ route('login') }}" data-parsley-validate enctype="multipart/form-data" method="POST" >
              @csrf
                <h1>Login / เข้าใช้งาน</h1>
              <div>
                <input type="text" id="email" name="email" class="form-control" placeholder="email" required="" />
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-info btn-sm btn-block">Login</button>

              </div>

              <div class="clearfix"></div>

              <div class="separator">




              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
