<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title." ".$guru->nama_pegawai ?></h1>
    <a href="<?php echo base_url('kepsek/slip_gaji')?>" class="btn btn-info">Kembali</a>
  </div>
</div>

<div class="container-fluid">
  <?php echo $this->session->flashdata('pesan_slip_gaji')?>
  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>Tahun</th>
              <th>Bulan</th>
              <th>Gaji Jabatan</th>
              <th>Gaji Tambahan</th>
              <th>Potongan Gaji</th>
              <th>Hasil</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_gaji as $key => $value): ?>
              <tr>
                <td><?= $value->tahun ?></td>
                <td><?= $value->bulan ?></td>
                <td>
                  Rp. 
                  <?php
                  $a=$gaji_jabatan->gaji_pokok+$gaji_jabatan->tj_transport+$gaji_jabatan->uang_makan;
                  echo number_format($a,0,',','.'); 
                  ?>
                </td>
                <td>
                  Rp. 
                  <?php
                  $b = $data_gaji_tunjangan;
                  echo number_format($b,0,',','.');
                  ?>
                </td>
                <td>
                  Rp.
                  <?php
                  $potongan_gaji = 0;
                  $gaji_potongan = $this->ModelJadwal->gaji_tambahan($guru->id_pegawai,$value->tahun,$value->bulan);
                  // var_dump($gaji_potongan->result());
                  foreach($gaji_potongan->result() as $key_gp => $value_gp ){
                    if ($value_gp->hadir!="Hadir") {
                      $potongan_gaji+=$value_gp->jml_potongan;
                    }
                  }
                  echo number_format($potongan_gaji,0,',','.');
                  ?>  
                </td>
                <td>
                  Rp.
                  <?php 
                  echo number_format(($a+$b)-$potongan_gaji,0,',','.');
                  ?>
                </td>
                <td>
                  <?php
                  $status = $this->ModelGaji->status($guru->id_pegawai,$value->tahun,$value->bulan);
                  // var_dump($status);
                  if ($status): ?>
                    <?php if ($status->status=='pengajuan'): ?>
                      <a href="<?= base_url('kepsek/slip_gaji/acc/'.$guru->id_pegawai.'/'.$value->tahun.'/'.$value->bulan) ?>" class="btn btn-sm btn-info">ACC GAJI</a>
                    <?php else: ?>
                      <a href="<?= base_url('kepsek/slip_gaji/print_gaji/'.$guru->id_pegawai.'/'.$value->tahun.'/'.$value->bulan) ?>" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-eye"></i></a>
                    <?php endif ?>
                  <?php else: ?>
                    BELUM ADA PENGAJUAN
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>