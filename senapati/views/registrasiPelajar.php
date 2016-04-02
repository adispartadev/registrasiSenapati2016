
<section class="content-header">
    <h1>
        Registrasi
        <small>Registrasi Pelajar</small>
    </h1>
</section>

<section class="content">
	
	<?php
		$view = "
		<div class=\"panel panel-default\">
			<div class=\"panel-heading\">
				Form Registrasi
			</div>
			<div class=\"panel-body\">
				<div class=\"row\">
					<form name=\"frmregistrasi\" method=\"post\" action=\"".BASE_URL.'/action/registrasiPelajar.php?action=daftar'."\" enctype=\"multipart/form-data\">
					<div class=\"col-lg-6\">
						<div class=\"form-group\">
							<label>Nama Peserta</label>
							<input type=\"text\" class=\"form-control\" name=\"nama\" required>
						</div>
						<div class=\"form-group\">
							<label>Email</label>
							<input type=\"text\" class=\"form-control\" name=\"email\" required>
						</div>
						<div class=\"form-group\">
							<label>Nama Bank Pengirim</label>
							<select class=\"form-control\" name=\"bank\" required>
								<option value=\"BCA\">BCA</option>
								<option value=\"BNI\">BNI</option>
								<option value=\"Mandiri\">Bank Mandiri</option>
								<option value=\"BRI\">BRI</option>
								<option value=\"Danamon\">Bank Danamon</option>
								<option value=\"Lain\">Lainnya</option>
							</select>
						</div>
						<div class=\"form-group\">
							<label>Nama Pemilik Rekening</label>
							<input type=\"text\" class=\"form-control\" name=\"pemilik\" required>
						</div>
						<div class=\"form-group\">
							<label>Tanggal Transfer</label>
							<div class=\"input-group \" >
								<input type=\"text\" class=\"form-control datepicker\" required name=\"tgl\">
								<div class=\"input-group-addon\">
									<span class=\"glyphicon glyphicon-th\"></span>
								</div>
							</div>
						</div>
						<div class=\"form-group\">
							<label>Bukti Transfer</label>
							<input type='file' name='bukti[]' required=''>
						</div>
						<div class=\"form-group\">
							<label>No Identitas</label>
							<input type=\"text\" class=\"form-control\" name=\"no_identitas\" required>
						</div>
						<div class=\"form-group\">
							<label>Gambar Identitas</label>
							<input type='file' name='identitas[]' required=''>
						</div>
						<input type=\"hidden\" name=\"jenis\" value=\"pelajar\">
						<input type=\"submit\" class=\"btn btn-primary\" value=\"Kirim\">
					</div>
					</form>
				</div>
			</div>
		</div>";
		
		echo $view;
	?>
	
</section>