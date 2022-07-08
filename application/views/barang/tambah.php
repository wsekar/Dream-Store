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
									<form action="<?= base_url('barang/proses_tambah') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_barang"><strong>Kode Barang</strong></label>
												<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $kode_barang = $this->M_barang->buatkode() ?>" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required>
											</div>
											<!-- <div class="form-group col-3">
												<label for="nama_kategori">Nama Kategori</label>
												<select name="nama_kategori" id="nama_kategori" class="form-control">
													<option value="">Pilih Kategori</option>
													<?php foreach ($all_kategori as $kategori) : ?>
														<option value="<?= $kategori->nama_kategori ?>"><?= $kategori->nama_kategori ?></option>
													<?php endforeach ?>
												</select>
											</div> -->
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="harga_jual"><strong>Harga Jual</strong></label>
												<input type="number" name="harga_jual" placeholder="Masukkan Harga Jual" autocomplete="off" class="form-control" required>
											</div>
											<div class="form-group col-md-6">
												<label for="stok"><strong>Stok</strong></label>
												<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="satuan"><strong>Satuan</strong></label>
												<select name="satuan" id="satuan" class="form-control" required>
													<option value="">-- Silahkan Pilih --</option>
													<option value="pcs">PCS</option>
													<option value="set">SET</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="foto_barang"><strong>Gambar</strong></label>
												<fieldset class="form-group">
													<input type="file" class="form-control-file" id="foto_barang" name="foto_barang">
												</fieldset>
											</div>
										</div>
										<!-- input field foto -->
										<div class="form-group">

										</div>
										<div class="form-group">
											<label for="deskripsi"><strong>Deskripsi</strong></label>
											<textarea class="form-control " id="deskripsi" name="deskripsi"></textarea>
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
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		CKEDITOR.replace('deskripsi')
	</script>
</body>

</html>