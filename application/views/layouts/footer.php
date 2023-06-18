  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?= base_url('assets/adminlte-v2')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?= base_url('assets/adminlte-v2')?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/moment/min/moment.min.js"></script>
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?= base_url('assets/adminlte-v2')?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/adminlte-v2')?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url('assets/adminlte-v2')?>/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/adminlte-v2')?>/dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- fullCalendar -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/moment/moment.js"></script>
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?= base_url('assets/adminlte-v2')?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script>
    $(function(){
      $('.table-datatable').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })

    })
    $('.input-datepicker').datepicker({
      autoclose: true
    })
    setInterval(function(){
      $('.alert').fadeOut();
    },3000)
  </script>
</body>
</html>