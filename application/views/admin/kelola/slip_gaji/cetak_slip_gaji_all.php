<!DOCTYPE html>
<html>
<head>
	<title>Daftar Gaji Guru <?= $nama_guru ?> Bulan <?= $bulan[DATE('m',strtotime($tanggal))-1]." ".DATE('Y',strtotime($tanggal)) ?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
		.text-center{
			text-align:center;
		}
		.text-right{
			text-align:right;
		}
		.text-left{
			text-align:left;
		}
		.text-justify{
			text-align:justify;
		}
	</style>
</head>
<body>
	<center>
		<h1>SMAN 1 NGANJUK</h1>
		<?php $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] ?>
		<h2>Daftar Gaji Guru Bulan <?= $bulan[DATE('m',strtotime($tanggal))-1]." ".DATE('Y',strtotime($tanggal)) ?></h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>
	<table style="width:100%" class="text-center">
		<tr>
			<th>
				<h3>
					No
				</h3>
			</th>
			<th>
				<h3>
					Nama Guru
				</h3>
			</th>
			<th>
				<h3>
					Gaji Pokok
				</h3>
			</th>
			<th>
				<h3>
					Potongan Gaji
				</h3>
			</th>
			<th>
				<h3>
					Gaji Tambahan
				</h3>
			</th>
			<th>
				<h3>
					Gaji Diterima
				</h3>
			</th>
		</tr>
		<?php
		$no=1;
		foreach ($slip_gaji as $key => $value) { 
			$gaji_pokok = $this->ModelAdminSlipGaji->gaji_pokok()*$this->ModelAdminKehadiran->data_kehadiran($value->id_guru,$tanggal);
			$alfa = $value->alfa*$this->ModelAdminSlipGaji->gaji_alfa();
			$izin = $value->izin*$this->ModelAdminSlipGaji->gaji_izin();
			$sakit = $value->sakit*$this->ModelAdminSlipGaji->gaji_sakit();
			$potongan_gaji = $alfa+$izin+$sakit;
			$gaji_tambahan = $this->ModelAdminSlipGaji->gaji_tambahan($value->id_guru);
			?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $this->ModelAdminSlipGaji->nama_guru($value->id_guru) ?></td>
				<td class="text-right"><?= 'Rp. '.number_format($gaji_pokok,0,',','.') ?></td>
				<td class="text-right"><?= 'Rp. '.number_format($potongan_gaji,0,',','.') ?></td>
				<td class="text-right"><?= 'Rp. '.number_format($gaji_tambahan,0,',','.') ?></td>
				<td class="text-right"><?= 'Rp. '.number_format(($gaji_pokok-$potongan_gaji)+$gaji_tambahan,0,',','.') ?></td>
			</tr>
			<?php 
			$no++;
		}
		?>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>