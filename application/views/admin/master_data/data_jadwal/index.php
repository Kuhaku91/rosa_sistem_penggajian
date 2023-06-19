<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_jadwal/tambah') ?>"><i class="fa fa-plus"></i> Tambah Jadwal </a>
    </span>
  </h1>
</section>
<style type="text/css">
  .libur{
    background-color:#000;
  }
  .ada_mapel{
    background-color:#66ff17;
  }
</style>
<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('pesan_jadwal') ?>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Filter Jadwal
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
              <div class="col-xs-4">
                <div class="form-group">
                  <input type="text" class="form-control pull-right input-sm input-datepicker" name="tanggal" value="<?= DATE('m/d/Y',strtotime($tanggal)) ?>">
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <select class="form-control input-sm" name="kelas">
                    <?php foreach ($data_kelas as $key => $value): ?>
                      <option value="<?= $value->id ?>" <?= $value->id==$kelas?'selected':'' ?>><?= $value->nama_kelas ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-4">
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
          DATA KODE PADA JADWAL
        </div>
        <div class="box-body">
          <table class="table table-sm table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>Nama Guru</th>
                <th>Tidak Ada Guru</th>
                <?php foreach ($data_pegawai as $key => $value): ?>
                  <th><?= $value->nama_pegawai ?></th>
                <?php endforeach ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Kode</td>
                <td>0</td>
                <?php foreach ($data_pegawai as $key => $value): ?>
                  <td><?= $value->id_pegawai ?></td>
                <?php endforeach ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <?php if ($tanggal!=''&&$kelas!=''): ?>
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <?php $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; ?>
            Jadwal Kelas <?= $this->ModelAdminJadwal->get_kelas($kelas) ?> Bulan <?= $bulan[DATE('m',strtotime($tanggal))-1] ?> Tahun <?= DATE('Y',strtotime($tanggal)) ?>
           </div>
          <div class="box-body">
            <table class="table table-sm table-bordered table-striped text-center">
              <thead>
                <tr>
                  <th>Jam / Tgl</th>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <th><?= $i ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>07.00 - 07.45</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(1,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>07.45 - 08.30</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(2,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>08.30 - 09.15</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(3,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>09.15 - 10.00</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(4,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td class="libur">Istirahat</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <td class="libur"><?= $i ?></td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>10.15 - 11.00</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(5,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>11.00 - 11.45</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(6,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>11.45 - 12.30</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(7,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td class="libur">Istirahat</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <td class="libur"><?= $i ?></td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>13.00 - 13.45</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(8,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>13.45 - 14.30</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(9,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>14.30 - 15.15</td>
                  <?php for ($i=1; $i < (DATE('t',strtotime($tanggal))+1); $i++) { ?>
                    <!-- <td><?= $i ?></td> -->
                      <?php $data_guru = $this->ModelAdminJadwal->get_guru(10,DATE('Y-m-',strtotime($tanggal)).$i,$kelas) ?>
                    <td class="<?= $data_guru!=0?'ada_mapel':'tidak_mapel' ?>">
                      <?= $data_guru ?>
                      </td>
                  <?php } ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>

</section>