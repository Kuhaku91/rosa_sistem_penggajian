<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= $title." ".$guru->nama_pegawai ?>
  </h1>
</section>


<!-- Main content -->
<section class="content">
  <a href="<?php echo base_url('kepsek/slip_gaji')?>" class="btn btn-sm btn-info">Kembali</a>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <?php echo $this->session->flashdata('pesan_slip_gaji')?>
        <div class="box-body">
          <table id="datatable" class="table table-sm table-bordered table-hover text-center">
            <thead class="thead-dark">
              <tr>
                <th>Nama Gaji</th>
                <th>Nominal</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>