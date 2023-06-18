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
	<?php 
	$jumlah_kehadiran = $this->ModelAdminKehadiran->data_kehadiran($id_pegawai,$tanggal);
	$nominal = $this->ModelAdminSlipGaji->gaji_pokok();

	$alfa = $this->ModelAdminKehadiran->data_alfa($id_pegawai,$tanggal);
	$izin = $this->ModelAdminKehadiran->data_izin($id_pegawai,$tanggal);
	$sakit = $this->ModelAdminKehadiran->data_sakit($id_pegawai,$tanggal);
	$nominal_alfa = $this->ModelAdminSlipGaji->gaji_alfa();
	$nominal_izin = $this->ModelAdminSlipGaji->gaji_izin();
	$nominal_sakit = $this->ModelAdminSlipGaji->gaji_sakit();
	?>
	<center>
		<h1>SMAN 1 NGANJUK</h1>
		<?php $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] ?>
		<h2>Daftar Gaji Guru <?= $nama_guru ?> Bulan <?= $bulan[DATE('m',strtotime($tanggal))-1]." ".DATE('Y',strtotime($tanggal)) ?></h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>
	<table style="width:100%">
		<tr>
			<td colspan="4">
				<h3>
					GAJI POKOK
				</h3>
			</td>
		</tr>
		<tr>
			<td class="text-center">No.</td>
			<td class="text-center">Jumlah Jadwal</td>
			<td class="text-center">Nominal</td>
			<td class="text-center">Total</td>
		</tr>
		<tr>
			<td class="text-center">1.</td>
			<td class="text-center"><?= $jumlah_kehadiran ?> Kali</td>
			<td class="text-right"><?= 'Rp. '.number_format($nominal,0,',','.') ?></td>
			<td class="text-right"><?= 'Rp. '.number_format($jumlah_kehadiran*$nominal,0,',','.') ?></td>
		</tr>
		<tr>
			<td colspan="4">
				<h3>
					POTONGAN GAJI
				</h3>
			</td>
		</tr>
		<tr>
			<td class="text-center">No.</td>
			<td class="text-center">Jumlah Potongan</td>
			<td class="text-center">Nominal</td>
			<td class="text-center">Total</td>
		</tr>
		<tr>
			<td class="text-center">1.</td>
			<td class="text-center">Alfa <?= $alfa ?> Kali</td>
			<td class="text-right"><?= 'Rp. '.number_format($nominal_alfa,'0',',','.') ?></td>
			<td class="text-right">Rp. <?= number_format($alfa*$nominal_alfa,0,',','.') ?></td>
		</tr>
		<tr>
			<td class="text-center">2.</td>
			<td class="text-center">Izin <?= $izin ?> Kali</td>
			<td class="text-right"><?= 'Rp. '.number_format($nominal_izin,'0',',','.') ?></td>
			<td class="text-right">Rp. <?= number_format($izin*$nominal_izin,0,',','.') ?></td>
		</tr>
		<tr>
			<td class="text-center">3.</td>
			<td class="text-center">Sakit <?= $sakit ?> Kali</td>
			<td class="text-right"><?= 'Rp. '.number_format($nominal_sakit,'0',',','.') ?></td>
			<td class="text-right">Rp. <?= number_format($sakit*$nominal_sakit,0,',','.') ?></td>
		</tr>
		<tr>
			<td colspan="3">
				<h3>
					GAJI TAMBAHAN
				</h3>
			</td>
		</tr>
		<tr>
			<td class="text-center">No.</td>
			<td colspan="2">Tambahan</td>
			<td class="text-center">Nominal</td>
		</tr>
		<?php $jumlah_tambahan=0; $no=1; foreach ($this->ModelAdminGaji->find_tunjangan($id_pegawai)->result() as $key => $value): ?>
		<tr>
			<td class="text-center"><?= $no ?></td>
			<td colspan="2"><?= $value->nama_gaji ?></td>
			<td class="text-right">Rp. <?= number_format($value->nominal,0,',','.') ?></td>
		</tr>
		<?php $jumlah_tambahan+=$value->nominal; $no++; endforeach ?>
		<tr>
			<td colspan="4">
				<h3>
					GAJI DITERIMA
				</h3>
			</td>
		</tr>
		<tr>
			<td class="text-center">Total</td>
			<td></td>
			<td></td>
			<td class="text-right">Rp. <?= number_format((($jumlah_kehadiran*$nominal)-(($alfa*$nominal_alfa)+($izin*$nominal_izin)+($sakit*$nominal_sakit)))+$jumlah_tambahan,0,',','.') ?></td>
		</tr>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>