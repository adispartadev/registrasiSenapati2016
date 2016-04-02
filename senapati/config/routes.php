<?php
	include 'config/db.php';
	include 'classes/db.php';
	$db = new db();
	
	include 'partials/header.php';

	if (isset($routes[0])){

		if ($routes[0] == 'registrasi'){
			if (isset($routes[1])){
				switch ($routes[1]) {
					case 'umum':
							include 'views/registrasiUmum.php';
						break;
					case 'pelajar':
							include 'views/registrasiPelajar.php';
						break;
					case 'pemakalah':
							include 'views/registrasiPemalakan.php';
						break;
					default:
						# code...
						break;
				}
			}
		}

		if ($routes[0] == 'login'){
			include 'views/login.php';
		}

		if ($routes[0] == 'lihatdata'){
			
			middleware(LOGIN);

			if (isset($routes[1])){
				switch ($routes[1]) {
					case 'pesertaumum':
							include 'views/lihatPesertaUmum.php';
						break;
					case 'pesertapelajar':
							include 'views/lihatPesertaPelajar.php';
						break;
					case 'pemakalah':
							include 'views/lihatPemakalah.php';
						break;
					default:
						# code...
						break;
				}
			}
		}


	}
	else{
		include 'views/dashboard.php';
	}

	include 'partials/footer.php';

