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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('kasir') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('kasir/proses_ubah/' . $kasir->id) ?>" id="form-tambah" method="POST">

										<div class="form-group">
											<label for="kode_kasir"><strong>Kode Kasir</strong></label>
											<input type="text" name="kode_kasir" placeholder="Masukkan Kode Kasir" autocomplete="off" class="form-control" required value="<?= $kasir->kode_kasir ?>" maxlength="8" readonly>
										</div>
										<div class="form-group">
											<label for="nama_kasir"><strong>Nama Kasir</strong></label>
											<input type="text" name="nama_kasir" placeholder="Masukkan Nama Kasir" autocomplete="off" class="form-control" required value="<?= $kasir->nama_kasir ?>">
										</div>
										<div class="form-group">
											<label for="username_kasir"><strong>Username</strong></label>
											<input type="text" name="username_kasir" placeholder="Masukkan Username" autocomplete="off" class="form-control" required value="<?= $kasir->username_kasir ?>">
										</div>
										<div class="form-group">
											<label for="email_kasir"><strong>Email</strong></label>
											<input type="email" name="email_kasir" placeholder="Masukkan Email" autocomplete="off" class="form-control" required value="<?= $kasir->email_kasir ?>">
										</div>
										<div class="form-group">
											<label for="password_kasir"><strong>Password</strong></label>
											<input type="password" name="password_kasir" placeholder="Masukkan Password" autocomplete="off" class="form-control" required value="<?= $kasir->password_kasir ?>" minlength="8">
										</div>
										<div class="form-group">
											<label for="jenis_kelamin_kasir"><strong>Jenis Kelamin</strong></label><br />
											<input type="radio" name="jenis_kelamin_kasir" id="laki-laki" value="Laki-Laki" <?php echo $kasir->jenis_kelamin_kasir ?> <?= $kasir->id == 0 ? "" : ($kasir->jenis_kelamin_kasir == "Laki-Laki" ? "checked" :  "") ?> />Laki-Laki
											<input type="radio" name="jenis_kelamin_kasir" id="perempuan" value="Perempuan" <?php echo $kasir->jenis_kelamin_kasir ?> <?= $kasir->id == 0 ? "" : ($kasir->jenis_kelamin_kasir == "Perempuan" ? "checked" :  "") ?> />Perempuan
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