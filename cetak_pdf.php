<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$orders = [];

if ($id) {
	$query = mysqli_query($koneksi, "SELECT pesanan.*, pelanggan.nama, pelanggan.no_handphone, pelanggan.alamat FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan WHERE pesanan.id_pesanan = $id");
	if ($row = mysqli_fetch_assoc($query)) {
		$orders[] = $row;
	}
} else {
	$query = mysqli_query($koneksi, "SELECT pesanan.*, pelanggan.nama, pelanggan.no_handphone, pelanggan.alamat FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan ORDER BY pesanan.tanggal DESC");
	while ($row = mysqli_fetch_assoc($query)) {
		$orders[] = $row;
	}
}
?>
<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak Pesanan</title>
	<style>
		body { font-family: Arial, Helvetica, sans-serif; color: #222; }
		.page { width: 210mm; margin: 10mm auto; }
		.header { text-align: center; margin-bottom: 12px; }
		.card { border: 1px solid #ddd; padding: 12px; margin-bottom: 12px; }
		table { width: 100%; border-collapse: collapse; }
		th, td { padding: 6px 8px; border: 1px solid #ddd; text-align: left; }
		.no-border td { border: none; padding: 2px 8px; }
		.right { text-align: right; }
		@media print { .page { margin: 0; } a { text-decoration: none; color: inherit; } }
	</style>
</head>
<body>
<div class="page">
	<div class="header">
		<h2>Daftar Pesanan</h2>
		<div>Service Sofa - Cetak <?= $id ? 'Pesanan' : 'Semua Pesanan' ?></div>
	</div>

	<?php if (empty($orders)) : ?>
		<p>Tidak ada data pesanan untuk dicetak.</p>
	<?php else: ?>
		<?php foreach ($orders as $ord): ?>
			<div class="card">
				<table class="no-border">
					<tr>
						<td><strong>Nama</strong></td>
						<td>: <?= htmlspecialchars($ord['nama']); ?></td>
						<td><strong>Tanggal</strong></td>
						<td>: <?= htmlspecialchars($ord['tanggal']); ?></td>
					</tr>
					<tr>
						<td><strong>No. HP</strong></td>
						<td>: <?= htmlspecialchars($ord['no_handphone']); ?></td>
						<td><strong>Status</strong></td>
						<td>: <?= htmlspecialchars($ord['status']); ?></td>
					</tr>
					<tr>
						<td><strong>Alamat</strong></td>
						<td colspan="3">: <?= nl2br(htmlspecialchars($ord['alamat'])); ?></td>
					</tr>
				</table>

				<br>
				<table>
					<thead>
						<tr>
							<th>Jenis Sofa</th>
							<th>Jenis Service</th>
							<th>Warna</th>
							<th class="right">Harga</th>
							<th class="right">DP</th>
							<th class="right">Sisa</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= htmlspecialchars($ord['jenis_sofa']); ?></td>
							<td><?= htmlspecialchars($ord['jenis_service']); ?></td>
							<td><?= htmlspecialchars($ord['warna']); ?></td>
							<td class="right">Rp <?= number_format($ord['harga'], 0, ',', '.'); ?></td>
							<td class="right">Rp <?= number_format($ord['dp'], 0, ',', '.'); ?></td>
							<td class="right">Rp <?= number_format($ord['sisa'], 0, ',', '.'); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

	<div style="font-size:12px; margin-top:20px;">Dicetak pada: <?= date('d-m-Y H:i'); ?></div>
</div>

<script>
	// Otomatis memanggil dialog cetak pada saat halaman dibuka
	window.onload = function() {
		window.print();
		// Jangan menutup otomatis di semua browser; beri jeda pendek
		setTimeout(function(){ /* window.close(); */ }, 500);
	}
</script>
</body>
</html>

