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
		<form method="POST" action="<?php echo base_url('admin/data_kelas/update_data_aksi')?>">
			
			<div class="form-group">
				<label>Nama Kelas</label>
				<input type="hidden" name="id_kelas" class="form-control" value="<?php echo $id; ?>">
				<input type="text" name="nama_kelas" class="form-control" value="<?php echo $nama_kelas; ?>">
				<?php echo form_error('nama_kelas', '<div class="text-small text-danger"> </div>')?>
			</div>

			<button type="submit" class="btn btn-success" >Simpan</button>
			<a href="<?php echo base_url('admin/data_kelas')?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>