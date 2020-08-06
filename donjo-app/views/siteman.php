<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			<?=$this->setting->login_title
				. ' ' . ucwords($this->setting->sebutan_desa)
				. (($header['nama_desa']) ? ' ' . $header['nama_desa']: '')
				. get_dynamic_title_page_from_path();
			?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex">
		<link rel="stylesheet" href="<?= base_url()?>assets/css/login-style.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/login-form-elements.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/bootstrap.bar.css" media="screen" type="text/css" />
		<?php if (is_file("desa/css/siteman.css")): ?>
			<link type='text/css' href="<?= base_url()?>desa/css/siteman.css" rel='Stylesheet' />
		<?php endif; ?>
		<?php if (is_file(LOKASI_LOGO_DESA ."favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?=LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
		<script src="<?= base_url()?>assets/bootstrap/js/jquery.min.js"></script>
		<?php require __DIR__ .'/head_tags.php' ?>
	</head>
	<body class="login">
		<div class="top-content">
			<div class="inner-bg">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4 form-box">
							<div class="form-top">
								<a href="<?=site_url(); ?>first/"><img src="<?=gambar_desa($header['logo']);?>" alt="<?=$header['nama_desa']?>" class="img-responsive" /></a>
								<div class="login-footer-top"><h1><?=ucwords($this->setting->sebutan_desa)?> <?=$header['nama_desa']?></h1>
									<h3>
										<br /><?=$header['alamat_kantor']?><br />Kodepos <?=$header['kode_pos']?>
										<br /><?=ucwords($this->setting->sebutan_kecamatan)?> <?=$header['nama_kecamatan']?><br /><?=ucwords($this->setting->sebutan_kabupaten)?> <?=$header['nama_kabupaten']?>
									</h3>
								</div>
								<hr />
							</div>
							<div class="form-bottom">
								<form class="login-form" action="<?=site_url('siteman/auth')?>" method="post" >
									<?php if ($_SESSION['siteman_wait']==1): ?>
										<div class="error login-footer-top">
											<p id="countdown" style="color:red; text-transform:uppercase"></p>
										</div>
									<?php else: ?>
										<div class="form-group">
											<input name="username" type="text" placeholder="Nama pengguna" <?php if ($_SESSION['siteman_wait']==1): ?> disabled="disabled"<?php endif ?> value="" required class="form-username form-control input-error">
										</div>
										<div class="form-group">
											<input name="password" id="password" type="password" placeholder="Kata sandi" <?php if ($_SESSION['siteman_wait']==1): ?>disabled="disabled"<?php endif ?> value="" required class="form-username form-control input-error">
										</div>
										<div class="form-group">
											<input type="checkbox" id="checkbox" class="form-checkbox"> Tampilkan kata sandi
										</div>
										<hr />
										<button type="submit" class="btn">MASUK</button>
										<?php if ($_SESSION['siteman']==-1): ?>
											<div class="error">
												<p style="color:red; text-transform:uppercase">Login Gagal.<br />Nama pengguna atau kata sandi yang Anda masukkan salah!<br />
												<?php if ($_SESSION['siteman_try']): ?>
													Kesempatan mencoba <?= ($_SESSION['siteman_try']-1); ?> kali lagi.</p>
												<?php endif; ?>
											</div>
										<?php elseif ($_SESSION['siteman']==-2): ?>
											<div class="error">
												Redaksi belum boleh masuk, SID belum memiliki sambungan internet!
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</form>
								<hr/>
								<div class="login-footer-bottom"><a href="https://github.com/OpenSID/OpenSID" target="_blank">OpenSID</a> <?= substr(AmbilVersi(), 0, 11)?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script src="<?= base_url()?>assets/bootstrap/js/jquery.min.js"></script>
<script>

	function start_countdown(){
		var times = eval(<?= json_encode($_SESSION['siteman_timeout'])?>) - eval(<?= json_encode(time())?>);
		var menit = Math.floor(times / 60); 
		var detik = times % 60;
		timer = setInterval(function(){ 
			detik--;
			if (detik <= 0 && menit >=1){ 
				detik = 60; 
				menit--;
			}
			if (menit <= 0 && detik <= 0){ 
				clearInterval(timer); 
				location.reload();
			} else {
				document.getElementById("countdown").innerHTML = "<b>Gagal 3 kali silakan coba kembali dalam "+menit+" MENIT "+detik+" DETIK </b>";
			}
		}, 1000)
	}

	$('document').ready(function()
	{
		var pass = $("#password");
		$('#checkbox').click(function(){
			if (pass.attr('type') === "password"){
				pass.attr('type', 'text');
			} else {
				pass.attr('type', 'password')
			}
		});

		if ($('#countdown').length)
		{
			start_countdown();
		}
	});

</script>
