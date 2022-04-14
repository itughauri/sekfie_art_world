<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
        <title>Login</title>
</head>
<body>
    <div id="app">
        <section class="section">
          <div class="container mt-5">
            <div class="row">
              <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Login</h4>
                  </div>
                  <div class="card-body">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form method="POST" action="{{ url('/auth/check') }}" class="needs-validation" novalidate="">
                        @csrf
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1"  autofocus>
                        @error('email')
                            <div class="alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">
                          Please fill in your email
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="d-block">
                          <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" >
                        @error('password')
                            <div class="alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">
                          please fill in your password
                        </div>
                      </div>
                      <div class="form-group">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Login
                        </button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/index.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>

