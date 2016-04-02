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

				$db->query("INSERT INTO pemakalah 
							(pem_id, pem_nama, pem_email, pem_bank, pem_tgl_trf, pem_image, pem_id_makalah, pem_jml_trf, jenis_id)
							VALUES 
							(:pem_id, :pem_nama, :pem_email, :pem_bank, :pem_tgl_trf, :pem_image, :pem_id_makalah, :pem_jml_trf, :jenis_id)");

				$db->bind(':pem_id', date('U'));
				$db->bind(':pem_nama', $_POST['namaPemakalah']);
				$db->bind(':pem_email', $_POST['email']);
				$db->bind(':pem_bank', $_POST['bank']);
				$db->bind(':pem_tgl_trf', $univ->tanggal_edit($_POST['tgl']));
				$db->bind(':pem_image', $namaGambar);
				$db->bind(':pem_id_makalah', $_POST['id_makalah']);
				$db->bind(':pem_jml_trf', $_POST['jml_trf']);
				$db->bind(':jenis_id', $_POST['id_jenis']);

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
				$limit = '';

				/**
				 * Get total Count
				 */
				$sql = "SELECT * FROM pemakalah";
				$db->query($sql);
				$recordsTotal = $db->rowCount();


				/**
				 * Get data
				 */
				if ( isset($_GET['start']) && $_GET['length'] != -1 ) {
					$limit = " LIMIT ".intval($_GET['start']).", ".intval($_GET['length']);
				}

				$sql = "SELECT * FROM pemakalah INNER JOIN jenis_pemakalah ON jenis_pemakalah.jenis_id = pemakalah.jenis_id ". $limit;;

				$db->query($sql);
				$recordData = $db->multiple();
				$pesertaData = array();

				foreach ($recordData as $key => $r) {
					$pesertaData[] = array(
							$r['pem_nama'],
							$r['pem_email'],
							$r['pem_bank'],
							$r['pem_image'],
							$r['pem_id_makalah'],
							$r['pem_tgl_trf'],
							$r['pem_jml_trf'],
							$r['jenis_deskripsi'],
							$r['pem_status'],
							$r['pem_id']
						);
				}
				
				$recordsFiltered = $db->rowCount();

				$s =  array(
					"draw"            => intval( $_GET['draw'] ),
					"recordsTotal"    => intval( $recordsTotal ),
					"recordsFiltered" => intval( $recordsFiltered ),
					"data"            => $pesertaData
				);

				echo json_encode($s);

			break;

		case 'validasi':
						$peserta_id = $_POST['peserta_id'];

						$sql = "UPDATE pemakalah SET pem_status = 'Validasi' WHERE pem_id = :peserta_id";

						$db->query($sql);
						$db->bind(':peserta_id', $peserta_id);

						if ($db->execute()){

							require_once '../classes/emailer/autoload.php';

							$sql = "SELECT pem_email FROM pemakalah WHERE pem_id = :peserta_id";
							$db->query($sql);
							$db->bind(':id_peserta', $peserta_id);
							$peserta = $db->single();

							$mail = new PHPMailer;
							$mail->From = EMAILFROM;
							$mail->FromName = EMAILFROMNAME;
							$mail->isHTML(true);
							$mail->Subject = "SENAPATI (Validasi Registrasi Peserta)";
							$mail->Body = '<h2>Registrasi Peserta</h2><p>Proses registrasi sebagai pemakalah berhasil dilakukan dan sudah di konfirmasi oleh panitia</p>';

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
						$sql = "DELETE FROM pemakalah WHERE pem_id = :peserta_id";
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