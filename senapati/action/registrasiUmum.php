<?php

	include('../config/db.php');
	include('../classes/db.php');
	include('../classes/upload.php');
	include('../classes/flashMessage.php');
	include('../classes/universal.php');
	include '../define.php';

	$db = new db();
	$univ = new universal();
	$flash = new flashMessage();

	switch ($_GET['action']) {
		case 'daftar':
				
				$up = new upload();
	            $foto = $up->uploadImg('../foto/', $_FILES['bukti']);
	            $namaGambar = $foto[0]['name'];

				$db->query("INSERT INTO peserta 
							(peserta_id, peserta_nama, peserta_email, peserta_bank, peserta_pemilik, peserta_tgl_trf, peserta_image, peserta_jenis)
							VALUES 
							(:id_peserta, :nama, :email, :bank, :pemilik, :tgl, :img, :jenis)");

				$db->bind(':id_peserta', date('U'));
				$db->bind(':nama', $_POST['nama']);
				$db->bind(':email', $_POST['email']);
				$db->bind(':bank', $_POST['bank']);
				$db->bind(':pemilik', $_POST['pemilik']);
				$db->bind(':tgl', $univ->tanggal_edit($_POST['tgl']));
				$db->bind(':img', $namaGambar);
				$db->bind(':jenis', $_POST['jenis']);

				if ($db->execute()){
                	$flash->setMessage('message', 'Registrasi berhasil dilakukan');
	            }
	            else{
	                $flash->setMessage('message', 'Maaf terjadi kesalahan');
	            }

            	$univ->back();

			break;
		
		case 'list':
				require_once '../classes/SSP.php';

						// DB table to use
						$table = 'peserta';
						 
						// Table's primary key
						$primaryKey = 'peserta_id';
						 
						// Array of database columns which should be read and sent back to DataTables.
						// The `db` parameter represents the column name in the database, while the `dt`
						// parameter represents the DataTables column identifier. In this case simple
						// indexes
						$columns = array(
						    array( 'db' => 'peserta_nama', 'dt' => 0 ),
						    array( 'db' => 'peserta_email',  'dt' => 1 ),
						    array( 'db' => 'peserta_bank',   'dt' => 2 ),
						    array( 'db' => 'peserta_pemilik',   'dt' => 3 ),
						    array( 'db' => 'peserta_tgl_trf',   'dt' => 4 ),
						    array(
				    				'db'        => 'peserta_image',
				    		        'dt'        => 5,
				    		        'formatter' => function( $d, $row ) {
				    		            return '<a style="text-decoration:none;" href="'.BASE_URL.'/foto/'.$d.'" target="_BLANK"><span class="label label-primary">Lihat</span></a>';
				    		        }
						    	),
						    array(
				    				'db'        => 'peserta_status',
				    		        'dt'        => 6,
				    		        'formatter' => function( $d, $row ) {
				    		            if ($d == 'Validasi'){
				    		            	return '<label class="label label-info">Validasi</label>';
				    		            }
				    		            else{
				    		            	return '<label class="label label-warning">Mengantri</label>';
				    		            }
				    		        }
						    	),
				    		    array(
				        				'db'        => 'peserta_id',
				        		        'dt'        => 7,
				        		        'formatter' => function( $d, $row ) {
				        		            return '<a style="text-decoration:none;" href="javascript:void(0);" onclick="validasi_user('.$d.')"><span class="label label-success">Validasi</span></a>
													<a style="text-decoration:none;" href="javascript:void(0);" onclick="hapus_user('.$d.')"><span class="label label-danger">Hapus</span></a>
				        		            ';
				        		        }
				    		    	)

						);
						 
						// SQL server connection information
						$sql_details = array(
						    'user' => DB_USER,
						    'pass' => DB_PASS,
						    'db'   => DB_NAME,
						    'host' => DB_HOST
						);
						 
						
						/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
						 * If you just want to use the basic configuration for DataTables with PHP
						 * server-side, there is no need to edit below this line.
						 */

						$where = " peserta_jenis = 'umum' ";
						// $where = " status = 1 ";
						echo json_encode(
						    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where)
						);

			break;

		case 'validasi':
				$peserta_id = $_POST['peserta_id'];

				$sql = "UPDATE peserta SET peserta_status = 'Validasi' WHERE peserta_id = :peserta_id";

				$db->query($sql);
				$db->bind(':peserta_id', $peserta_id);

				if ($db->execute()){

					require_once '../classes/emailer/autoload.php';

					$sql = "SELECT peserta_email FROM peserta WHERE peserta_id = :peserta_id";
					$db->query($sql);
					$db->bind(':id_peserta', $peserta_id);
					$peserta = $db->single();

					$mail = new PHPMailer;
					$mail->From = EMAILFROM;
					$mail->FromName = EMAILFROMNAME;
					$mail->isHTML(true);
					$mail->Subject = "SENAPATI (Validasi Registrasi Peserta)";
					$mail->Body = '<h2>Registrasi Peserta</h2><p>Proses registrasi berhasil dilakukan dan sudah di konfirmasi oleh panitia</p>';

					$mail->addAddress($peserta['peserta_email']);

					if (!$mail->send()){
						$flash->setMessage('message', 'Maaf, terjadi kesalahan');
					}
					else{
						$flash->setMessage('message', 'Validasi peserta berhasil dilakukan');
					}
				}



			break;

		case 'delete':
				$peserta_id = $_POST['peserta_id'];
				$sql = "DELETE FROM peserta WHERE peserta_id = :peserta_id";
				$db->query($sql);
				$db->bind(':peserta_id', $peserta_id);
				if($db->execute()){
					$flash->setMessage('message', 'Peserta berhasil dihapus');
				}
				else{
					echo 'error';
				}
			break;

		default:
			# code...
			break;
	}