
<section class="content-header">
    <h1>
        Daftar
        <small>Peserta Umum</small>
    </h1>
</section>

<section class="content">
	
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Peserta Umum
		</div>
		<div class="panel-body table-responsive table-hover">
			<table id="table-basic" class="table">
			    <thead>
			        <tr>
			            <th>Nama Peserta</th>
			            <th>Email</th>
			            <th>Bank</th>
			            <th>Pemilik</th>
			            <th>Tgl Transfer</th>
			            <th>Bukti</th>
			            <th>Status</th>
			            <th></th>
			        </tr>
			    </thead>

			    <tbody id="target">
			    	
			    </tbody>
			
			</table>
		</div>
	</div>

</section>

<script>
	$(function(){
	    $('#table-basic').dataTable( {
	        "processing": true,
	        "serverSide": true,
	        "ajax": "<?php echo BASE_URL ?>/action/registrasiUmum.php?action=list"
	    });
	});

	function validasi_user(peserta_id){
		$.ajax({
			type : "POST",
			url : "<?php echo BASE_URL ?>/action/registrasiUmum.php?action=validasi",
			data : {peserta_id},
			success : function(e){
				if (e == null || e == ''){
					location.reload();
				}
				else{
					alert("Maaf, terjadi kesalahan");
				}
			} 
		});
	}

	function hapus_user(peserta_id){
		var aa = confirm("Hapus peserta ini?");
		if (aa == true){
			$.ajax({
			type : "POST",
			url : "<?php echo BASE_URL ?>/action/registrasiUmum.php?action=delete",
			data : {peserta_id},
			success : function(e){
				if (e == null || e == ''){
					location.reload();
				}
				else{
					alert("Maaf, terjadi kesalahan");
				}
			} 
		});
		}
	}
</script>