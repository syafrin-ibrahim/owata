<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * File ini:
 *
 * View untuk Peta Web
 *
 * donjo-app/views/gis/content_desa_web.php,
 *
 */

/**
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package	OpenSID
 * @author	Tim Pengembang OpenDesa
 * @copyright	Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright	Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license	http://www.gnu.org/licenses/gpl.html	GPL V3
 * @link 	https://github.com/OpenSID/OpenSID
 */
?>

<div id="isi_popup" style="visibility: hidden;">
	<div id="content">
		<center><h5 id="firstHeading" class="firstHeading"><b>Wilayah <?= set_ucwords($wilayah); ?></b></h5></center>
		<div id="bodyContent">
			<p><center><a href="#collapseStatGraph" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Statistik Penduduk" data-toggle="collapse" data-target="#collapseStatGraph" aria-expanded="false" aria-controls="collapseStatGraph"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Statistik Penduduk&nbsp;&nbsp;</a></center></p>
			<div class="collapse box-body no-padding" id="collapseStatGraph">
				<div class="card card-body">
					<?php foreach ($list_lap as $key => $value): ?>
						<li <?= jecho($lap, $key, 'class="active"'); ?>><a href="<?= site_url("statistik_web/chart_gis_desa/$key/" . underscore($desa[nama_desa])); ?>" data-remote="false" data-toggle="modal" data-target="#modalSedang" data-title="Statistik Penduduk <?= set_ucwords($wilayah) ?>"><?= $value ?></a></li>
					<?php endforeach; ?>
				</div>
			</div>
			<p><center><a href="<?= site_url("first/load_aparatur_desa"); ?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-title="Aparatur <?= ucwords($this->setting->sebutan_desa)?>" data-remote="false" data-toggle="modal" data-target="#modalKecil"><i class="fa fa-user"></i>&nbsp;&nbsp;Aparatur <?= ucwords($this->setting->sebutan_desa)?>&nbsp;&nbsp;</a></center></p>
			<p><center><a href="<?= site_url("first/load_apbdes"); ?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-title="Laporan APBDES 2019 - Grafik" data-remote="false" data-toggle="modal" data-target="#modalSedang"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Grafik Keuangan&nbsp;&nbsp;</a></center></p>
		</div>
	</div>
</div>