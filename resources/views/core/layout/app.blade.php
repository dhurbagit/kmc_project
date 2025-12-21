  <!DOCTYPE html>
  <html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>SB Admin 2 - Dashboard</title>

      <!-- Custom fonts for this template-->
      <link href="{{ asset('core/fontawesome-free-7.1.0-web/css/all.css') }}" rel="stylesheet" type="text/css">
      <link
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
 <link href="{{ asset('core/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset('core/css/sb-admin-2.min.css') }}" rel="stylesheet">
      <link href="{{ asset('core/css/style.css') }}" rel="stylesheet">
      <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  </head>

  <body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper">

          <!-- Sidebar -->
          @include('core.layout.sidebar')
          <!-- End of Sidebar -->

          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">

              <!-- Main Content -->
              <div id="content">

                  <!-- Topbar -->
                  @include('core.layout.header')
                  <!-- End of Topbar -->

                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                      @yield('content')

                  </div>
                  <!-- /.container-fluid -->

              </div>
              <!-- End of Main Content -->

              <!-- Footer -->
              @include('core.layout.footer')
              <!-- End of Footer -->

          </div>
          <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Model-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                  <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="login.html">Logout</a>
                  </div>
              </div>
          </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('core/vendor/jquery/jquery.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script src="{{ asset('core/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

      <!-- Core plugin JavaScript-->
      <script src="{{ asset('core/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

      <!-- Custom scripts for all pages-->
      <script src="{{ asset('core/js/sb-admin-2.min.js') }}"></script>

          <!-- Page level plugins -->
    <script src="{{ asset('core/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('core/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('core/js/demo/datatables-demo.js') }}"></script>
      <!-- Page level plugins -->
      {{-- <script src="{{ asset('core/vendor/chart.js/Chart.min.js') }}"></script> --}}

      <!-- Page level custom scripts -->
      {{-- <script src="{{ asset('core/js/demo/chart-area-demo.js') }}"></script> --}}
      {{-- <script src="{{ asset('core/js/demo/chart-pie-demo.js') }}"></script> --}}
      <script>
          // toster ja
          @if (Session::has('message'))
              toastr.options = {
                  "closeButton": true,
                  pies.forEach((p, i) => renderSectorPieChart({
                      canvasId: `deptPie_${i}`,
                      labels: p.labels,
                      used: p.used,
                      allocated: p.alloc,
                      sectorIds: p.sector_ids,
                      departmentId: p.department_id,
                      fiscalCode: fiscalCode
                  }));
                  "progressBar": true
              }
              toastr.success("{{ session('message') }}");
          @endif

          @if (Session::has('error'))
              toastr.options = {
                  "closeButton": true,
                  "progressBar": true
              }
              toastr.error("{{ session('error') }}");
          @endif

          @if (Session::has('info'))
              toastr.options = {
                  "closeButton": true,
                  "progressBar": true
              }
              toastr.info("{{ session('info') }}");
          @endif

          @if (Session::has('warning'))
              toastr.options = {
                  "closeButton": true,
                  "progressBar": true
              }
              toastr.warning("{{ session('warning') }}");
          @endif
      </script>
      @stack('scripts')

  </body>

  </html>
