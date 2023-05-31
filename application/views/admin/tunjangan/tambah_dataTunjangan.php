<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

</div>
<!-- /.container-fluid -->

<div class="card" style="width: 60% ; margin-bottom: 100px">
	<div class="card-body">
		<form method="POST" action="<?php echo base_url('admin/data_tunjangan/tambah_data_aksi')?>">

			<div class="form-group">
				<label>Nama Tunjangan</label>
				<input type="text" name="nama_tunjangan" class="form-control">
				<?php echo form_error('nama_tunjangan', '<div class="text-small text-danger"> </div>')?>
			</div>

			<button type="submit" class="btn btn-success" >Simpan</button>
			<button type="reset" class="btn btn-danger" >Reset</button>
			<a href="<?php echo base_url('admin/data_tunjangan')?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>