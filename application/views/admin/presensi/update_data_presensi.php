<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title." ".$data_guru['nama_pegawai'] ?></h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="container-fluid">
	<?php echo $this->session->flashdata('pesan_presensi')?>
	<div class="card">
		<?php if ($this->ModelPresensi->get_id($data_jadwal['id'])): ?>
			
			<!-- Ada -->
			<div class="card-body">
				<form method="POST" action="<?= base_url('admin/presensi/update/').$data_jadwal['id'] ?>">

					<?php 
					$data_posisi = $this->ModelPresensi->get_id($data_jadwal['id']);
					if ($data_posisi->hadir=='Hadir') {
						$posisi=$data_posisi->hadir;
					}
					else{
						$posisi=$data_posisi->id_potongan;
					}
					// echo $posisi;
					?>

					<div class="form-group">
						<label>Presensi</label>
						<select name="presensi" class="form-control">
							<option value="Hadir" <?= 'Hadir'==$posisi? 'selected':'' ?>>Hadir</option>
							<?php foreach ($potongan as $key => $value): ?>
								<option value="<?= $value->id ?>" <?= $value->id==$posisi? 'selected':'' ?>><?= $value->potongan ?></option>
							<?php endforeach ?>
						</select>
					</div>

					<button type="submit" class="btn btn-success" >Update</button>
					<a href="<?php echo base_url('admin/presensi?tanggal='.$data_jadwal['tanggal'])?>" class="btn btn-warning">Kembali</a>
				</form>
			</div>

		<?php else: ?>

			<!-- Tidak -->
			<div class="card-body">
				<form method="POST" action="<?= base_url('admin/presensi/add/').$data_jadwal['id'] ?>">
					<div class="form-group">
						<label>Presensi</label>
						<select name="presensi" class="form-control">
							<option value="Hadir">Hadir</option>
							<?php foreach ($potongan as $key => $value): ?>
								<option value="<?= $value->id ?>"><?= $value->potongan ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<button type="submit" class="btn btn-success" >Simpan</button>
					<a href="<?php echo base_url('admin/presensi?tanggal='.$data_jadwal['tanggal'])?>" class="btn btn-warning">Kembali</a>
				</form>
			</div>

		<?php endif ?>

	</div>
</div>