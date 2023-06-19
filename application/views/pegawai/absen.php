<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('pesan_jadwal') ?>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Filter Absen
            <br>
            <small style="color:#000 !important">
              ( data yang ditampilkan adalah data bulanan berdasarkan tanggal yang dipilih )
            </small>
          </h3>
        </div>
        <div class="box-body">
          <form>
            <div class="row">
              <?= $this->session->flashdata('pesan_jadwal_tambah') ?>
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
    <div class="col-xs-12">
      <div class="box">

        <div class="box-body">
          <table id="datatable" class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kehadiran</th>
                <th>Alfa</th>
                <th>Izin</th>
                <th>Sakit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
              foreach ($absen as $key => $value): 
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $bulan[DATE('m',strtotime($value->tanggal))-1].' '.DATE('Y',strtotime($value->tanggal)) ?></td>
                  <td><?= $this->ModelGuruKehadiran->data_kehadiran($value->id_guru,$value->tanggal) ?></td>
                  <td><?= $value->alfa; ?></td>
                  <td><?= $value->izin; ?></td>
                  <td><?= $value->sakit; ?></td>
                </tr>
                <?php
                $no++;
              endforeach
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>