<section class="content-header">
    <h1>
        Login
        <small>Masuk Akun Admin</small>
    </h1>
</section>

<section class="content">
	<br>
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Login Administrator
				</div>
				<div class="panel-body">
					<?php
						echo "<form name=\"frmregistrasi\" method=\"post\" action=\"".BASE_URL.'/action/all.php?action=login'."\">
								<div class=\"form-group\">
									<label>Username</label>
									<input type=\"text\" class=\"form-control\" name=\"username\" required>
								</div>
								<div class=\"form-group\">
									<label>Password</label>
									<input type=\"password\" class=\"form-control\" name=\"password\" required>
								</div>
								<input type=\"submit\" class=\"btn btn-primary\" value=\"Kirim\">
							</form>";
					?>
				</div>
			</div>
		</div>
	</div>
</section>