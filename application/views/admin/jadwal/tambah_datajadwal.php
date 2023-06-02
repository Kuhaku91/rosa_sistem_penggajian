<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
		<a href="<?= base_url() ?>admin/data_jadwal/" class="btn btn-success">
			<i class="fas fa-arrow-left"></i> KEMBALI
		</a>
	</div>

</div>
<!-- /.container-fluid -->

<div class="container-fluid">
	<div class="card shadow">
		<div class="card-body">
			<?php echo $this->session->flashdata('pesan_jadwal_add')?>
			<form method="POST" action="<?php echo base_url('admin/data_jadwal/simpan')?>" enctype="multipart/form-data">

				<div class="form-group">
					<label>Nama Pegawai</label>
					<select name="pegawai" class="form-control">
						<?php foreach($pegawai as $j) :?>
							<option value="<?php echo $j->id_pegawai ?>"><?php echo $j->nama_pegawai ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Mapel</label>
					<select name="mapel" class="form-control">
						<?php foreach($mapel as $j) :?>
							<option value="<?php echo $j->id ?>"><?php echo $j->nama_mapel ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Kelas</label>
					<select name="kelas" class="form-control">
						<?php foreach($kelas as $j) :?>
							<option value="<?php echo $j->id ?>"><?php echo $j->nama_kelas ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control">
					<?php echo form_error('tanggal', '<div class="text-small text-danger"> </div>')?>
				</div>
				<div class="form-group">
					<label>Jam</label>
					<select name="jam" class="form-control">
						<option value="1">07.30 - 08.15</option>
						<option value="2">08.15 - 09.00</option>
						<option value="3">09.00 - 09.45</option>
						<option value="4">10.00 - 10.45</option>
						<option value="5">10.45 - 11.30</option>
						<option value="6">11.30 - 12.15</option>
						<option value="7">12.45 - 13.30</option>
						<option value="8">13.30 - 14.15</option>
						<option value="9">14.15 - 15.00</option>
					</select>
				</div>

				<button type="submit" class="btn btn-success" >Simpan</button>
				<button type="reset" class="btn btn-danger" >Reset</button>
				<a href="<?php echo base_url('admin/data_jadwal')?>" class="btn btn-warning">Kembali</a>

			</form>
		</div>
	</div>
</div>