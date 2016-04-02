
    </div>

    <footer class="main-footer">

        <strong>Copyright &copy; 2016 <a href="http://pti.undiksha.ac.id">Pendidikan Teknik Informatika</a>.</strong> All rights reserved.
    </footer>


    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<script src="<?php echo BASE_URL; ?>/resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>/resources/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>/resources/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>/resources/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>/resources/dist/js/demo.js" type="text/javascript"></script>
</body>
</html>


<?php
	include ('classes/flashMessage.php');
	$flash = new flashMessage();

	if ( $flash->checkMessage('message') ){
		?>
		<script>
			alert('<?php echo $flash->showMessage("message"); ?>');
		</script>
<?php
	}

?>