<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $title?>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">

				<div class="box-body">
					<table id="datatable" class="table table-bordered table-hover text-center">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>NUPTK</th>
								<th>Nama Guru</th>
								<th>Jenis Kelamin</th>
								<th>Photo</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; ?> 
							<?php foreach($pegawai as $p) : ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $p->nik ?></td>
									<td><?php echo $p->nama_pegawai ?></td>
									<td><?php echo $p->jenis_kelamin ?></td>
									<td><img src="<?php echo base_url().'photo/'.$p->photo?>" width="50px"></td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo base_url('kepsek/slip_gaji/cetak_gaji/'.$p->id_pegawai) ?>">
											<i class="fa fa-eye"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</section>