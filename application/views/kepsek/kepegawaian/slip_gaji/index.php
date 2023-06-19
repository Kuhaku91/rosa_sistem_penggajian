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
          <a href="<?= base_url('kepsek/kepegawaian/slip_gaji/print_all?tanggal=').$tanggal ?>" class="btn btn-success btn-sm pull-right" target="_blank">
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
              <?php $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
              $no=1;
              foreach ($slip_gaji as $key => $value) { 
                $gaji_pokok = $this->ModelKepsekSlipGaji->gaji_pokok()*$this->ModelKepsekKehadiran->data_kehadiran($value->id_guru,$tanggal);
                $alfa = $value->alfa*$this->ModelKepsekSlipGaji->gaji_alfa();
                $izin = $value->izin*$this->ModelKepsekSlipGaji->gaji_izin();
                $sakit = $value->sakit*$this->ModelKepsekSlipGaji->gaji_sakit();
                $potongan_gaji = $alfa+$izin+$sakit;
                $gaji_tambahan = $this->ModelKepsekSlipGaji->gaji_tambahan($value->id_guru);
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $this->ModelKepsekSlipGaji->nama_guru($value->id_guru) ?></td>
                  <td><?= 'Rp. '.number_format($gaji_pokok,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format($potongan_gaji,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format($gaji_tambahan,0,',','.') ?></td>
                  <td><?= 'Rp. '.number_format(($gaji_pokok-$potongan_gaji)+$gaji_tambahan,0,',','.') ?></td>
                  <td>
                    <?php
                    if($this->ModelKepsekSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)) {
                      if ($this->ModelKepsekSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)->status=='pengajuan') {
                        ?>
                        <form action="<?= base_url('kepsek/kepegawaian/slip_gaji/persetujuan?tanggal=').$tanggal ?>" method="POST">
                          <button type="submit" value="<?= $value->id_guru ?>" name="id_pegawai" class="btn btn-sm btn-success pull-left" >MENYETUJUI PENGAJUAN</button>
                        </form>
                        <?php
                      }
                      else if($this->ModelKepsekSlipGaji->cek_slip_gaji($value->id_guru,$tanggal)->status=='diterima') {
                        ?>
                        <form action="<?= base_url('kepsek/kepegawaian/slip_gaji/print?tanggal=').$tanggal ?>" method="POST" target="_blank">
                          <button type="submit" value="<?= $value->id_guru ?>" name="id_pegawai" class="btn btn-sm btn-primary pull-left" ><i class="fa fa-print"></i></button>
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
                      <form action="<?= base_url('kepsek/kepegawaian/slip_gaji/ajukan?tanggal=').$tanggal ?>" method="POST">
                        <button class="btn btn-sm btn-info pull-left" >MENUNGGU PENGAJUAN GAJI</button>
                      </form>
                      <?php
                    }
                    ?>
                    <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#<?= $value->id_guru.'-'.$tanggal ?>">
                      <i class="fa fa-eye"></i>
                    </button>

                    <div class="modal fade" id="<?= $value->id_guru.'-'.$tanggal ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Data Gaji Bulan <?= $bulan[DATE('m',strtotime($tanggal))-1]." ".DATE('Y',strtotime($tanggal)) ?></h4>
                            </div>
                            <div class="modal-body">
                              <?php 
                              $jumlah_kehadiran = $this->ModelKepsekKehadiran->data_kehadiran($value->id_guru,$tanggal);
                              $nominal = $this->ModelKepsekSlipGaji->gaji_pokok();

                              $alfa = $this->ModelKepsekKehadiran->data_alfa($value->id_guru,$tanggal);
                              $izin = $this->ModelKepsekKehadiran->data_izin($value->id_guru,$tanggal);
                              $sakit = $this->ModelKepsekKehadiran->data_sakit($value->id_guru,$tanggal);
                              $nominal_alfa = $this->ModelKepsekSlipGaji->gaji_alfa();
                              $nominal_izin = $this->ModelKepsekSlipGaji->gaji_izin();
                              $nominal_sakit = $this->ModelKepsekSlipGaji->gaji_sakit();
                              ?>
                              <table style="width:100%">
                                <tr>
                                  <td colspan="4">
                                    <h5 class="pull-left">
                                      GAJI POKOK
                                    </h5>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-center">No.</td>
                                  <td class="text-center">Jumlah Jadwal</td>
                                  <td class="text-center">Nominal</td>
                                  <td class="text-center">Total</td>
                                </tr>
                                <tr>
                                  <td class="text-center">1.</td>
                                  <td class="text-center"><?= $jumlah_kehadiran ?> Kali</td>
                                  <td class="text-right"><?= 'Rp. '.number_format($nominal,0,',','.') ?></td>
                                  <td class="text-right"><?= 'Rp. '.number_format($jumlah_kehadiran*$nominal,0,',','.') ?></td>
                                </tr>
                                <tr>
                                  <td colspan="4">
                                    <h5 class="pull-left">
                                      POTONGAN GAJI
                                    </h5>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-center">No.</td>
                                  <td class="text-center">Jumlah Potongan</td>
                                  <td class="text-center">Nominal</td>
                                  <td class="text-center">Total</td>
                                </tr>
                                <tr>
                                  <td class="text-center">1.</td>
                                  <td class="text-center">Alfa <?= $alfa ?> Kali</td>
                                  <td class="text-right"><?= 'Rp. '.number_format($nominal_alfa,'0',',','.') ?></td>
                                  <td class="text-right">Rp. <?= number_format($alfa*$nominal_alfa,0,',','.') ?></td>
                                </tr>
                                <tr>
                                  <td class="text-center">2.</td>
                                  <td class="text-center">Izin <?= $izin ?> Kali</td>
                                  <td class="text-right"><?= 'Rp. '.number_format($nominal_izin,'0',',','.') ?></td>
                                  <td class="text-right">Rp. <?= number_format($izin*$nominal_izin,0,',','.') ?></td>
                                </tr>
                                <tr>
                                  <td class="text-center">3.</td>
                                  <td class="text-center">Sakit <?= $sakit ?> Kali</td>
                                  <td class="text-right"><?= 'Rp. '.number_format($nominal_sakit,'0',',','.') ?></td>
                                  <td class="text-right">Rp. <?= number_format($sakit*$nominal_sakit,0,',','.') ?></td>
                                </tr>
                                <tr>
                                  <td colspan="4">
                                    <h5 class="pull-left">
                                      GAJI TAMBAHAN
                                    </h5>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-center">No.</td>
                                  <td colspan="2">Tambahan</td>
                                  <td class="text-center">Nominal</td>
                                </tr>
                                <?php $jumlah_tambahan=0; $no=1; foreach ($this->ModelKepsekGaji->find_tunjangan($value->id_guru)->result() as $key => $value): ?>
                                <tr>
                                  <td class="text-center"><?= $no ?></td>
                                  <td colspan="2"><?= $value->nama_gaji ?></td>
                                  <td class="text-right">Rp. <?= number_format($value->nominal,0,',','.') ?></td>
                                </tr>
                                <?php $jumlah_tambahan+=$value->nominal; $no++; endforeach ?>
                                <tr>
                                  <td colspan="4">
                                    <h5 class="pull-left">
                                      GAJI DITERIMA
                                    </h5>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-center">Total</td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-right">Rp. <?= number_format((($jumlah_kehadiran*$nominal)-(($alfa*$nominal_alfa)+($izin*$nominal_izin)+($sakit*$nominal_sakit)))+$jumlah_tambahan,0,',','.') ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

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