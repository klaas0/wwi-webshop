<footer class="footer footer-black footer-big">
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-4">
					<h5>About Us</h5>
					<p>WWI loves to create the best products for their customers.</p>
					<p>We love our customers and we care deeply about their wished. That's why we as a group have created this webshop. We will be improving it every day! </p>
				</div>

				<div class="col-md-4">
					<h5>Social Feed</h5>
					<div class="social-feed">
						<div class="feed-line">
							<i class="fa fa-twitter"></i>
							<p>How to handle ethical disagreements with your clients.</p>
						</div>
						<div class="feed-line">
							<i class="fa fa-twitter"></i>
							<p>The tangible benefits of designing at 1x pixel density.</p>
						</div>
						<div class="feed-line">
							<i class="fa fa-facebook-square"></i>
							<p>A collection of 25 stunning sites that you can use for inspiration.</p>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<h5>Instagram Feed</h5>
				</div>
			</div>
		</div>
		<hr>
		<ul class="float-left">
			<li>
				<a href="<?=Text::URL;?>/etc/contact-us/">
					Contact Us
				</a>
			</li>
			<li>
				<a href="<?=Text::URL;?>/etc/privacy-policy/">
				   Privacy Policy
				</a>
			</li>
			<li>
				<a href="<?=Text::URL;?>/etc/tos/">
					Terms of Service
				</a>
			</li>
		</ul>

		<div class="copyright float-right">
			Copyright © 2018 WorldWideImporters.
		</div>
	</div>
</footer>

<!--Hier komt Modal-->
<!--
   Hieronder is de login modal te vinden, dit is een popup het moment dat er iemand op login klikt.
   Daar is een registratie pagina te vinden mocht er nog geen account bestaan voor de klant, Die knop opent een nieuwe modal en sluit the login-modal
   Op de registratie modal is een knop te vinden om terug te gaan naar de login modal, die sluit de registratie modal en open de login modal
   Ook is op de registratie modal een knop te vinden om de huidig ingevulde informatie te versturen, Het moment dat dit correct is ingevoerd word de data in de database gezet, de registratie modal gesloten en de login modal opnieuw geopend.
   -->
<div class="modal fade" id="loginModal" tabindex="-1" role="">
   <div class="modal-dialog modal-signup" role="document">
      <div class="modal-content">
         <div class="card card-signup card-plain">
            <div class="modal-header">
               <h5 class="modal-title card-title">Login</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <i class="material-icons">clear</i>
               </button>
            </div>
            <div class="modal-body">
               <div class="card-body">
                  <div class="form-group bmd-form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="material-icons">email</i></div>
                        </div>
                        <input type="text" class="form-control" placeholder="Email...">
                     </div>
                  </div>
                  <div class="form-group bmd-form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="material-icons">lock_outline</i></div>
                        </div>
                        <input type="password" placeholder="Wachtwoord..." class="form-control">
                     </div>
                  </div>
               </div>
               <div class="form-row justify-content-center">
                    <button type="submit" class="btn btn-primary">Log-in</button>
                    <button data-dismiss="modal" data-toggle="modal" data-target="#signupModal" class="btn btn-primary">Nieuw account aanmaken</button>
                 </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- registratie modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-signup" role="document">
      <div class="modal-content">
         <div class="card card-signup card-plain">
            <div class="modal-header">
               <h5 class="modal-title card-title">Registreer</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <i class="material-icons">clear</i>
               </button>
            </div>
            <div style="padding-top:10px;" class="modal-body">
                  <div class="row">
                  <div class="col-md-5 ml-auto">
                     <form id="register" class="form" method="" action="">
                     <div class="card-body">
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">face</i></div>
                                 </div>
                                 <input required type="text" id="inputNaam" class="form-control" placeholder="Naam...">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">email</i></div>
                                 </div>
                                 <input required type="text" id="inputEmail" class="form-control" placeholder="Email...">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">lock_outline</i></div>
                                 </div>
                                 <input required id="inputWachtwoord" type="password" placeholder="Wachtwoord..." class="form-control" />
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div id="result"></div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div id="progressbar"></div>
                              </div>
                           </div>
                        </div>
                  </div>
                  <div class="col-md-5 mr-auto">
                        <div class="card-body">
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">room</i></div>
                                 </div>
                                 <input type="text" class="form-control" id="inputAdres" placeholder="Adres">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">local_shipping</i></div>
                                 </div>
                                 <input type="text" class="form-control" id="inputPostcode" placeholder="Postcode">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">store_mall_directory</i></div>
                                 </div>
                                 <input type="text" placeholder="Plaats" id="inputPlaats" class="form-control" />
                              </div>
                           </div>
                           <div class="form-check">
                              <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                              <span class="check"></span>
                              </span>
                              Ik accepteer de <a href="#something">terms and conditions</a>.
                              </label>
                           </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                           <a href="" class="btn btn-primary btn-round">Registreer Account</a>
                        </div>
                        <div class="modal-footer justify-content-center">
                           <a id="loginbutton" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" href="" class="btn btn-primary btn-round">Naar Log-in pagina</a>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#password').keyup(function() {
      $('#result').html(checkStrength($('#password').val()))
      })
      function checkStrength(password) {
         var strength = 0
         if (password.length < 6) {
         $('#result').removeClass()
         $('#result').addClass('short')
         $( "#progressbar" ).progressbar({
            value: 5
          });
          $(".ui-widget-header").css("background","red");
         return 'Te kort'
      }
      if (password.length > 7) strength += 1
      // If password contains both lower and uppercase characters, increase strength value.
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
      // If it has numbers and characters, increase strength value.
      if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
      // If it has one special character, increase strength value.
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // If it has two special characters, increase strength value.
      if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // Calculated strength value, we can return messages
      // If value is less than 2
      if (strength < 2) {
         $('#result').removeClass()
         $('#result').addClass('weak')
         $( "#progressbar" ).progressbar({
            value: 33
         });
         $(".ui-widget-header").css("background","orange");
         return 'Zwak'
      } else if (strength == 2) {
         $('#result').removeClass()
         $('#result').addClass('good')
         $( "#progressbar" ).progressbar({
            value: 66
         });
          $(".ui-widget-header").css("background","Blue");
         return 'Goed'
      } else {
         $('#result').removeClass()
         $('#result').addClass('strong')
         $( "#progressbar" ).progressbar({
            value: 100
         });
          $(".ui-widget-header").css("background","green");
         return 'Perfect'
      }
   }
   
   $("#searchproduct").click(function() {
      if($('#navbartoggler').is(':visible')){
         $("#searchinput").get(0).focus();
         console.log('Hidden');
      } else {
         console.log('Visible');
      }
   });
});
</script>

<script src="<?=Text::URL;?>/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/bootstrap-tagsinput.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<script async defer src="https://buttons.github.io/buttons.js" type="text/javascript"></script>
<script src="<?=Text::URL;?>/assets/js/material-kit.js" type="text/javascript"></script>