<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url('photo/').$this->session->userdata('photo') ?>" style="height: 30px !important;width: 30px !important;" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $this->session->userdata('nama_pegawai')?></p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->

    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= base_url('kepsek/dashboard') ?>">
          <i class="fa fa-dashboard"></i><span>DASHBOARD</span>
        </a>
      </li>
      <li class="header">KEPEGAWAI</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>KEPEGAWAIAN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?= base_url('kepsek/slip_gaji') ?>">
              <i class="fa fa-circle-o"></i>SLIP GAJI
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>