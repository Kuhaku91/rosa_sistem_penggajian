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
    background-color: red;
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
              ( data yang ditampilkan adalah data mingguan berdasarkan tanggal yang dipilih )
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

    <!-- <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          Kelas
        </div>
        <div class="box-body">
          <table class="table table-sm table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>Jam</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jum'at</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>07.00 - 07.45</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>07.45 - 08.30</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>08.30 - 09.15</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>09.15 - 10.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
              </tr>
              <tr>
                <td>10.15 - 11.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>11.00 - 11.45</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>11.45 - 12.30</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
                <td class="libur"></td>
              </tr>
              <tr>
                <td>13.00 - 13.45</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>13.45 - 14.30</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>14.30 - 15.15</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->

  </div>

</section>