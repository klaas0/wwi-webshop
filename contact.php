<?php
require('utils/framework.php');
include('checkcontact.php');


?>
<html>
	<head>
		<?php require_once('utils/snippets/header.php');?>
	</head>
	<body class="profile-page">
		<?php require_once('utils/snippets/navbar.php'); ?>
		<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?=Text::URL;?>/assets/images/bg1.jpg'); transform: translate3d(0px, 0px, 0px);">
		</div>
		<div class="main main-raised">
			<div class="container">
			    <div class="card card-plain">
			        <div class="card-body">
			            <form id="contact" class="form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <h3 class="section-title">Contact</h3>
                    <div class="success"><?= $success ?></div>
                    <div class="row">
                    <div class="section col-md-5 ml-auto pr-1">
                        <div class="form-group">
                            <label for="naam">Naam</label>
                            <input value="<?= $naam ?>" required type="text" name="naam" maxlength="50" class="form-control" placeholder="" tabindex="1" autofocus>
                            <span class="error"><?= $naam_error ?></span>
                        </div>
                        <div class="form-group">
                            <label for="onderwerp">Onderwerp</label>
                            <input value="<?= $onderwerp ?>" required  type="text" name="onderwerp" maxlength="100" class="form-control" placeholder="" tabindex="3">
                            <span class="error"><?= $onderwerp_error ?></span>
                        </div>
                        <div class="form-group">
                            <label for="bericht">Bericht</label>
                            <textarea required name="bericht" maxlength="2500" rows="10" class="form-control" placeholder="" tabindex="5"><?= $bericht ?></textarea>
                            <span class="error"><?= $bericht_error ?></span>
                        </div>
                    </div>
                    <div class="section col-md-5 mr-auto pl-1">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input value="<?= $email ?>" required type="text" name="email" maxlength="50" class="form-control" placeholder="" tabindex="2">
                            <span class="error"><?= $email_error ?></span>
                        </div>
                        <div class="form-group">
                            <label for="telefoon">Telefoon</label>
                            <input value="<?= $telefoon ?>" type="text" name="telefoon" maxlength="10" class="form-control" placeholder="" tabindex="4">
                            <span class="error"><?= $telefoon_error ?></span>
                        </div>
                        <div class="form-group">
                            <button name="submit" class="btn btn-primary btn-round" type="submit" id="contact-submit" data-submit="...Sending">Verstuur</button>
                        </div>
                    </div>
                    </div>
                </form>
			        </div>
			    </div>
			</div>
		</div>
		<?php require_once('utils/snippets/footer.php');?>
	</body>
</html>