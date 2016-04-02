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
				$id_peserta = date('U');
				$db->bind(':id_peserta', $id_peserta);
				$db->bind(':nama', $_POST['nama']);
				$db->bind(':email', $_POST['email']);
				$db->bind(':bank', $_POST['bank']);
				$db->bind(':pemilik', $_POST['pemilik']);
				$db->bind(':tgl', $univ->tanggal_edit($_POST['tgl']));
				$db->bind(':img', $namaGambar);
				$db->bind(':jenis', $_POST['jenis']);

				if ($db->execute()){

					$gb = $up->uploadImg('../foto/', $_FILES['identitas']);
	            	$gambarIdentitas = $foto[0]['name'];

					$db->query("INSERT INTO pelajar VALUES(:id_pelajar, :no_identitas, :gambar)");
					$db->bind(':id_pelajar', $id_peserta);
					$db->bind(':no_identitas', $_POST['no_identitas']);
					$db->bind(':gambar', $gambarIdentitas);
					$db->execute();
					
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
				$sql = "SELECT * FROM pelajar WHERE peserta_jenis = 'pelajar'";
				$db->query($sql);
				$recordsTotal = $db->rowCount();


				/**
				 * Get data
				 */
				if ( isset($_GET['start']) && $_GET['length'] != -1 ) {
					$limit = " LIMIT ".intval($_GET['start']).", ".intval($_GET['length']);
				}

				$sql = "SELECT * FROM peserta INNER JOIN pelajar ON pelajar.id_peserta = peserta.peserta_id ". $limit;;

				$db->query($sql);
				$recordData = $db->multiple();
				$pesertaData = array();

				foreach ($recordData as $key => $r) {
					$pesertaData[] = array(
							$r['peserta_id'],
							$r['peserta_nama'],
							$r['peserta_email'],
							$r['peserta_bank'],
							$r['peserta_pemilik'],
							$r['peserta_tgl_trf'],
							$r['peserta_image'],
							$r['no_identitas'],
							$r['image'],
							$r['peserta_status']
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

				$sql = "DELETE FROM pelajar WHERE id_peserta = :peserta_id";
				$db->query($sql);
				$db->bind(':peserta_id', $peserta_id);
				$db->execute();

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