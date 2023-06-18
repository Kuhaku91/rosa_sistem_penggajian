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
    <?= $this->session->flashdata('gaji_guru') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Data Gaji Tambahan
          </h3>
          <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add_tunjangan">
            <i class="fa fa-plus"></i> TUNJANGAN
          </button>
          <div class="modal fade" id="add_tunjangan">
            <div class="modal-dialog">
              <div class="modal-content">

                <form action="<?= base_url('admin/kelola/gaji_guru/tambah') ?>" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Gaji Tunjangan</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Nama Pegawai</label>
                      <select name="pegawai" class="form-control">
                        <?php foreach($pegawai as $j) :?>
                          <option value="<?= $j->id_pegawai ?>"><?= $j->nama_pegawai ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Tunjangan</label>
                      <select name="tunjangan" class="form-control">
                        <?php foreach($tunjangan as $j) :?>
                          <option value="<?= $j->id ?>"><?= $j->nama_gaji ?>&emsp;Rp. <?= number_format($j->nominal,0,',','.') ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success pull-right">SIMPAN</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-datatable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">NAMA GURU</th>
                <th class="text-center">NOMINAL</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($data as $key => $value): ?>
              <tr>
                <td class="text-center"><?= $no ?></td>
                <td class="text-center"><?= $value->nama_pegawai ?></td>
                <td class="text-center"><?= 'Rp. '.number_format($this->ModelAdminGaji->nominal_gaji($value->id_pegawai),0,',','.') ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#view_gaji_tambahan_<?= $value->id_pegawai ?>">
                    <i class="fa fa-eye"></i>
                  </button>
                </td>
              </tr>

              <div class="modal fade" id="view_gaji_tambahan_<?= $value->id_pegawai ?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Gaji Tambahan <?= $value->nama_pegawai ?></h4>
                    </div>
                    <div class="modal-body">
                      <?php foreach ($this->ModelAdminGaji->find_tunjangan($value->id_pegawai)->result() as $key => $value): ?>
                      <div class="modal-footer">
                        <span class="pull-left"><?= $value->nama_gaji ?></span>
                        <span >Rp. <?= number_format($value->nominal,0,',','.') ?></span>
                        <a href="<?= base_url('admin/kelola/gaji_guru/hapus').'/'.$value->id_guru.'/'.$value->id_gaji ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                      </div>
                    <?php endforeach ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <?php $no++; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</section>