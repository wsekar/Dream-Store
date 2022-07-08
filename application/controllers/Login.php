<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->login) redirect('dashboard');
		$this->load->model('M_kasir', 'm_kasir'); //akan meload pada model kasir
		$this->load->model('M_pengguna', 'm_pengguna'); // meload model pengguna
	}

	public function index()
	{
		$this->load->view('login'); // meload halaman login (view -> login)
	}

	public function proses_login()
	{
		if ($this->input->post('role') === 'kasir') $this->_proses_login_kasir($this->input->post('username'));
		// saat menginputkan username untuk kasir maka akan terjadi proses login menuju halaman kasir
		elseif ($this->input->post('role') === 'admin') $this->_proses_login_admin($this->input->post('username'));
		// saat menginputkan username untuk admin maka akan terjadi proses login menuju halaman admin
		else { // selain kondisi diatas maka role tidak tersedia
?>
			<script>
				alert('role tidak tersedia!')
			</script>
<?php
		}
	}

	protected function _proses_login_kasir($username)
	{ //fungsi proses login untuk kasir
		$get_kasir = $this->m_kasir->lihat_username($username); // mendeteksi username yang di inputkan
		if ($get_kasir) {
			if ($get_kasir->password_kasir == $this->input->post('password')) { // menginputkan password 
				$session = [
					// dilakukan pengecekkan
					'kode' => $get_kasir->kode_kasir,
					'nama' => $get_kasir->nama_kasir,
					'username' => $get_kasir->username_kasir,
					'password' => $get_kasir->password_kasir,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s') //input jam masuk
				];

				$this->session->set_userdata('login', $session); //
				// menambahkan flash data
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!'); // menampilkan pesan login berhasil ('set_flashdata' -> didapat dari library session)
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!'); // menambahkan flash data jika password salah
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!'); // menambahkan flash data jika username salah
			redirect();
		}
	}
	// proses login admin ini sama dengan login kasir
	protected function _proses_login_admin($username)
	{
		$get_pengguna = $this->m_pengguna->lihat_username($username);
		if ($get_pengguna) {
			if ($get_pengguna->password_pengguna == $this->input->post('password')) {
				$session = [
					'kode' => $get_pengguna->kode_pengguna,
					'nama' => $get_pengguna->nama_pengguna,
					'username' => $get_pengguna->username_pengguna,
					'password' => $get_pengguna->password_pengguna,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}
