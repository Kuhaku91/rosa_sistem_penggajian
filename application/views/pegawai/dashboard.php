<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $title?>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-4 col-lg-3 col-xl-3"></div>
		<div class="col-md-6 col-lg-6 col-xl-6">
			<!-- Widget: user widget style 1 -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="<?= base_url('foto/').$this->session->userdata('photo') ?>" alt="User profile picture">

					<h3 class="profile-username text-center"><?= $this->session->userdata('nama_pegawai') ?></h3>

					<p class="text-muted text-center"></p>

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Nama Pegawai</b> <a class="pull-right"><?= $this->session->userdata('nama_pegawai') ?></a>
						</li>
						<li class="list-group-item">
							<b>Nik</b> <a class="pull-right"><?= $this->session->userdata('nik') ?></a>
						</li>
						<li class="list-group-item">
							<b>Jenis Kelamin</b> <a class="pull-right"><?= $this->session->userdata('jenis_kelamin') ?></a>
						</li>
						<li class="list-group-item">
							<b>Username</b> <a class="pull-right"><?= $this->session->userdata('username') ?></a>
						</li>
					</ul>

					<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.widget-user -->
		</div>
		<div class="col-md-4 col-lg-3 col-xl-3"></div>
	</div>
</section>