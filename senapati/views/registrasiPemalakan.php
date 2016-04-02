<section class="content-header">
    <h1>
        Registrasi
        <small>Registrasi Pemakalah</small>
    </h1>
</section>

<?php
	$sql = "SELECT * FROM jenis_pemakalah";
	$db->query($sql);
	$jenis_pemakalah = $db->multiple();
?>

<section class="content">
	
	<?php
		$view = "
		<div class=\"panel panel-default\">
			<div class=\"panel-heading\">
				Form Registrasi
			</div>
			<div class=\"panel-body\">
				<div class=\"row\">
					<form name=\"frmregistrasi\" method=\"post\" action=\"".BASE_URL.'/action/registrasiPemakalah.php?action=daftar'."\" enctype=\"multipart/form-data\">
					<div class=\"col-lg-6\">
						<div class=\"form-group\">
							<label>Nama Pemakalah</label>
							<input type=\"text\" class=\"form-control\" name=\"namaPemakalah\" required>
						</div>
						<div class=\"form-group\">
							<label>Email</label>
							<input type=\"email\" class=\"form-control\" name=\"email\" required>
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
							<label>Tanggal Transfer</label>
							<div class=\"input-group \" >
								<input type=\"text\" class=\"form-control datepicker\" name=\"tgl\" required>
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
							<label>Id Makalah</label>
							<input type=\"text\" class=\"form-control\" name=\"id_makalah\" required>
						</div>
						<div class=\"form-group\">
							<label>Jumlah Transfer</label>
							<input type=\"text\" class=\"form-control\" name=\"jml_trf\" required>
						</div>
						<div class=\"form-group\">
							<label>Jenis Pemakalah</label>
							<select class=\"form-control\" name=\"id_jenis\" required>
								";

								foreach ($jenis_pemakalah as $key => $value) {
									$view .= '<option value="'.$value['jenis_id'].'">'.ucfirst($value['jenis_deskripsi']).'</option>';
								}

								$view .= "
							</select>
						</div>
						<input type=\"submit\" class=\"btn btn-primary\" value=\"Kirim\">
					</div>
					</form>
				</div>
			</div>
		</div>";
		
		echo $view;
	?>

</section>