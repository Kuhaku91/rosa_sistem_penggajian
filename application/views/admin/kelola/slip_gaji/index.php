<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Data Slip Gaji -->
  <div class="row">
    <?= $this->session->flashdata('slip_gaji') ?>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Slip Gaji
            <br>
            <small style="color:#000 !important">
              ( data yang ditampilkan adalah data bulan yang dipilih berdasarkan tanggal )
              <br>
              ( data gaji yang ditampilkan adalah guru yang sudah melakukan absen )
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
        <div class="box-header">
          <a href="<?= base_url('admin/kelola/slip_gaji/print_all?tanggal=').$tanggal ?>" class="btn btn-success btn-sm pull-right" target="_blank">
            <i class="fa fa-print"></i> PRINT ALL
          </a>
        </div>
        <div class="box-body">
          <table class="table table-sm table-bordered table-striped text-center table-datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Gaji Pokok</th>
                <th>Potongan Gaji</th>
                <th>Gaji Tambahan</th>
                <th>Gaji Diterima</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($slip_gaji as $key => $value) { 
                $gaji_pokok = $this->ModelAdminSlipGaji->gaji_pokok()*$this->ModelAdminKehadiran->data_kehadiran($value->id_guru,$tanggal);
                $alfa = $value->alfa*$this->ModelAdminSlipGaji->gaji_alfa();
                $izin = $value->izin*$this->ModelAdminSlipGaji->gaji_izin();
                $sakit = $value->sakit*$this->ModelAdminSlipGaji->gaji_sakit();
                $potongan_gaji = $alfa+$izin+$sakit;
                $gaji_tambahan = $this->ModelAdminSlipGaji->gaji_tambahan($value->id_guru);
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $this->ModelAdminSlipGaji->nama_guru($value->id_guru) ?></td>
                  <td><?= 'Rp. '.number_format($gaji_pokok,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format($potongan_gaji,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format($gaji_tambahan,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format(($gaji_pokok-$potongan_gaji)+$gaji_tambahan,0,',','.') ?></td>
                  <td>
                    <?php
                    if($this->ModelAdminSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)) {
                      if ($this->ModelAdminSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)->status=='pengajuan') {
                        ?>
                        <button class="btn btn-sm btn-default">MENUNGGU PERSETUJUAN</button>
                        <?php
                      }
                      else if($this->ModelAdminSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)->status=='diterima') {
                        ?>
                        <form action="<?= base_url('admin/kelola/slip_gaji/print?tanggal=').$tanggal ?>" method="POST" target="_blank">
                          <button type="submit" value="<?= $value->id_guru ?>" name="id_pegawai" class="btn btn-sm btn-primary" ><i class="fa fa-print"></i></button>
                        </form>
                        <?php
                      }
                      else {
                        ?>
                        <button class="btn btn-sm btn-danger">DITOLAK</button>
                        <?php
                      }
                    }
                    else{
                      ?>
                      <form action="<?= base_url('admin/kelola/slip_gaji/ajukan?tanggal=').$tanggal ?>" method="POST">
                        <button type="submit" value="<?= $value->id_guru ?>" name="id_pegawai" class="btn btn-sm btn-info" >AJUKAN GAJI</button>
                      </form>
                      <?php
                    }
                    ?>
                  </td>
                </tr>
                <?php 
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>