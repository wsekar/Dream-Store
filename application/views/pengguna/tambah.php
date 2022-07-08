<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('pengguna') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('pengguna') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('pengguna/proses_tambah') ?>" id="form-tambah" method="POST">

										<div class="form-group ">
											<label for="kode_pengguna"><strong>Kode Pengguna</strong></label>
											<input type="text" name="kode_pengguna" autocomplete="off" class="form-control" required value="<?= $kode_pengguna = $this->M_pengguna->buatkode() ?>" readonly>
										</div>
										<div class="form-group ">
											<label for="nama_pengguna"><strong>Nama Pengguna</strong></label>
											<input type="text" name="nama_pengguna" placeholder="Masukkan Nama Pengguna" autocomplete="off" class="form-control js-name" required>
										</div>
										<div class="form-group">
											<label for="username_pengguna"><strong>Username</strong></label>
											<input type="text" name="username_pengguna" placeholder="Masukkan Username" autocomplete="off" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="password_pengguna"><strong>Password</strong></label>
											<input type="text" name="password_pengguna" placeholder="Masukkan Password" autocomplete="off" class="form-control" minlength="8" required>
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

</body>

</html>

<script>
	function alphaOnly() {
		let nameInput = document.querySelectorAll('.js-name');
		nameInput.forEach((input) => {

			input.addEventListener('keydown', (e) => {
				let charCode = e.keyCode;

				if ((charCode >= 65 && charCode <= 90) || charCode == 8 || charCode == 32) {
					null;
				} else {
					e.preventDefault();
				}
			});
		});
	}

	alphaOnly();
</script>