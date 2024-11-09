<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  {{-- w3 css --}}
  <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/')}}alte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/')}}alte/dist/css/adminlte.min.css">
    <!-- summernote -->
  <link rel="stylesheet" href="{{asset('/')}}alte/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
   @includeIf('admin.layouts.nav')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @includeIf('admin.layouts.sidebar')
  </aside>


  <div class="content-wrapper">
    <section class="content pt-3">
        @include('sweetalert::alert')
        @yield('content')
    </section>
  </div>


  @includeIf('admin.layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/')}}alte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}alte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}alte/dist/js/adminlte.min.js"></script>


<!-- Summernote -->
<script src="{{asset('/')}}alte/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            height: 200,
            tabsize: 2,
            codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
            }
        });
    })
</script>
@stack('js')
</body>
</html>
