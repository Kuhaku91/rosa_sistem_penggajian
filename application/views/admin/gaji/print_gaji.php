<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak Slip Gaji</title>
	<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<center>
		<h1>SMAN 1 NGANJUK</h1>
		<h2>Daftar Gaji Guru</h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>
	<br>
	<br>
	<table class="table table-sm table-bordered mt-3">
		<thead>
			<tr>
				<th>JENIS GAJI</th>
				<th>RINCIAN</th>
				<th>JUMLAH</th>
			</tr>
		</thead>
		<tbody>
			<!-- Gaji Pokok -->
			<tr>
				<td rowspan="4">GAJI POKOK</td>
			</tr>
			<tr>
				<td>GAJI JABATAN</td>
				<td>Rp. <?= number_format($gaji_pokok->gaji_pokok,0,',','.'); ?></td>
			</tr>
			<tr>
				<td>TRANSPORT</td>
				<td>Rp. <?= number_format($gaji_pokok->tj_transport,0,',','.'); ?></td>
			</tr>
			<tr>
				<td>UANG MAKAN</td>
				<td>Rp. <?= number_format($gaji_pokok->uang_makan,0,',','.'); ?></td>
			</tr>
			<!-- Gaji Tambahan -->
			<tr>
				<td rowspan="<?= $c_gaji_tambahan ?>">GAJI TAMBAHAN</td>
			</tr>
			<?php $plus=0 ?>
			<?php foreach ($gaji_tambahan as $key => $value): ?>
				<?php $plus+=$value->jumlah ?>
				<tr>
					<td><?= $value->nama_gaji ?></td>
					<td>Rp. <?= number_format($value->jumlah,0,',','.'); ?></td>
				</tr>
			<?php endforeach ?>
			<!-- Gaji Potongan -->
			<tr>
				<td rowspan="<?= $c_gaji_potongan ?>">GAJI POTONGAN</td>
			</tr>
			<?php foreach ($gaji_potongan->result() as $key => $value): ?>
				<?php $minus=0; ?>
				<?php if ($value->hadir!="Hadir"): ?>
					<?php $minus+=$value->jml_potongan ?>
					<tr>
						<td><?= $value->potongan ?></td>
						<td>Rp. <?= number_format($value->jml_potongan,0,',','.'); ?></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
			<tr>
				<td colspan="2">TOTAL</td>
				<td >
					Rp.
					<?=
					number_format(
						(
							$gaji_pokok->gaji_pokok+
							$gaji_pokok->tj_transport+
							$gaji_pokok->uang_makan
						)+
						$plus-$minus,
						0,
						',',
						'.'
					);
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>