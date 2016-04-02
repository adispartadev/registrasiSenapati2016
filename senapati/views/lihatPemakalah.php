
<section class="content-header">
    <h1>
        Daftar
        <small>Lihat Pemakalah</small>
    </h1>
</section>

<section class="content">
	
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Pemakalah
		</div>
		<div class="panel-body table-responsive table-hover">
			<table id="table-basic" class="table">
			    <thead>
			        <tr>
			            <th>Nama Pemakalah</th>
			            <th>Email</th>
			            <th>Bank</th>
			            <th>Bukti</th>
			            <th>Id Makalah</th>
			            <th>Tanggal Transfer</th>
			            <th>Jumlah Transfer</th>
			            <th>Jenis</th>
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
	        "ajax": "<?php echo BASE_URL ?>/action/registrasiPemakalah.php?action=list",
	        columns: [
	        		        	{data: 0},
	        		        	{data: 1},
	        		        	{data: 2},
	        		        	{data: 3,
	        		        		render : function(data, type, full, meta){
	        	                        return '<a target="_BLANK" class="label label-primary" href="<?php echo BASE_URL ?>/foto/'+data+'">Lihat</a>'
	        	                    }
	        	                },
	        		        	{data: 4},
	        		        	{data: 5},
	        		        	{data: 6},
	        		        	{data: 7},
	        		        	{data: 8,
	        		        		render : function(data, type, full, meta){
	        	                       	if (data === 'Mengantri')
	        	                       	{
	        	                       		return '<label class="label label-warning">Mengantri</label>';
	        	                       	}
	        	                       	return '<label class="label label-info">Validasi</label>';
	        	                    }
	        	                },
                	        	{data: 9,
                	        		render : function(data, type, full, meta){
                                       	return '<a style="text-decoration:none;" href="javascript:void(0);" onclick="validasi_user('+data+')"><span class="label label-success">Validasi</span></a><a style="text-decoration:none;" href="javascript:void(0);" onclick="hapus_user('+data+')"><span class="label label-danger">Hapus</span></a>';
                                    }
                	        	}
	        ]
	    });
	});

	function validasi_user(peserta_id){
		$.ajax({
			type : "POST",
			url : "<?php echo BASE_URL ?>/action/registrasiPemakalah.php?action=validasi",
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
			url : "<?php echo BASE_URL ?>/action/registrasiPemakalah.php?action=delete",
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