<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>

	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_barang"><strong>Kode Barang</strong></label>
												<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required value="<?= $barang->nama_barang ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="stok"><strong>Stok</strong></label>
												<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off" class="form-control" required value="<?= $barang->stok ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="harga_jual"><strong>Harga Jual</strong></label>
												<input type="number" name="harga_jual" placeholder="Masukkan Harga Jual" autocomplete="off" class="form-control" required value="<?= $barang->harga_jual ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="satuan"><strong>Satuan</strong></label>
												<select name="satuan" id="satuan" class="form-control" required>
													<option value="">-- Silahkan Pilih --</option>
													<option value="pcs" <?= $barang->satuan == 'pcs' ? 'selected' : '' ?>>PCS</option>
													<option value="set" <?= $barang->satuan == 'set' ? 'selected' : '' ?>>SET</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="foto_barang"><strong>Gambar</strong></label>
												<input type="file" name="foto_barang" class="form-control-file" id="foto_barang" value=" <?= $barang->foto_barang ?>">
												<img src="<?= base_url() . './assets/images/' . $barang->foto_barang ?>" width="200" height="200">
												<input type="hidden" name="file_name" value="<?= $barang->foto_barang ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="deskripsi"><strong>Deskripsi</strong></label>
											<textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Product description..."><?= $barang->deskripsi ?></textarea>
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
		<script>
			CKEDITOR.replace('deskripsi')
		</script>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>

</html>