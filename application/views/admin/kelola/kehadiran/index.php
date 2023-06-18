<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Data Gaji Tunjangan -->
  <div class="row">
    <?= $this->session->flashdata('kehadiran') ?>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Input Kehadiran
            <br>
            <small style="color:#000 !important">
              ( data yang ditampilkan adalah data bulan yang dipilih berdasarkan tanggal )
            </small>
          </h3>
        </div>
        <div class="box-body">
          <form>
            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <input type="text" class="form-control pull-right input-sm input-datepicker" name="tanggal" value="<?= DATE('m/d/Y',strtotime($tanggal)) ?>">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <button class="btn btn-sm btn-warning"><i class="fa fa-eye"></i>&ensp;CHECK</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?= base_url('admin/kelola/kehadiran/update') ?>?tanggal=<?= $tanggal ?>" method="POST">
          <div class="box-header">
            <button type="submit" class="btn btn-success btn-sm pull-right">
              <i class="fa fa-check"></i> UPDATE
            </button>
          </div>
          <div class="box-body">
            <table class="table table-sm table-bordered table-striped text-center table-datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Guru</th>
                  <th>Hadir</th>
                  <th>Alfa</th>
                  <th>Izin</th>
                  <th>Sakit</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; 
                foreach($guru as $key => $value):
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td>
                      <input type="hidden" name="id_pegawai[]" value="<?= $value->id_pegawai ?>">
                      <?= $value->nama_pegawai ?>
                    </td>
                    <td>
                      <input type="hidden" name="hadir[]" value="<?= $this->ModelAdminKehadiran->data_kehadiran($value->id_pegawai,$tanggal) ?>">
                      <?= $this->ModelAdminKehadiran->data_kehadiran($value->id_pegawai,$tanggal) ?>
                    </td>
                    <td>
                      <input class="form-control" style="width:100px !important;text-align: right;" type="number" name="alfa[]" value="<?= $this->ModelAdminKehadiran->data_alfa($value->id_pegawai,$tanggal) ?>">
                    </td>
                    <td>
                      <input class="form-control" style="width:100px !important;text-align: right;" type="number" name="izin[]" value="<?= $this->ModelAdminKehadiran->data_izin($value->id_pegawai,$tanggal) ?>">
                    </td>
                    <td>
                      <input class="form-control" style="width:100px !important;text-align: right;" type="number" name="sakit[]" value="<?= $this->ModelAdminKehadiran->data_sakit($value->id_pegawai,$tanggal) ?>">
                    </td>
                  </tr>
                  <?php $no++; 
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>