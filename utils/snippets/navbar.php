<nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg" color-on-scroll="200">
   <div class="container">
      <div class="navbar-translate">
         <a class="navbar-brand" href="<?=Text::URL;?>">
         <img src="<?=Text::URL;?>/assets/images/site_logo.png" width="30" height="30">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="sr-only">Toggle navigation</span>
         <span class="navbar-toggler-icon"></span>
         <span class="navbar-toggler-icon"></span>
         <span class="navbar-toggler-icon"></span>
         </button>
      </div>
      <div class="navbar-collapse collapse">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="<?=Text::URL;?>">
               <i class="material-icons">home</i>
               Home
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="<?=Text::URL;?>/products">
               <i class="material-icons">apps</i>
               Producten
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="<?=Text::URL;?>/contact">
               <i class="material-icons">contact_support</i>
               Contact
               </a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="dropdown nav-item d-none d-lg-block d-xl-block">
               <a id="searchproduct" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
               </a>
               <div id="navbartoggler" style="min-width:18rem;" class="dropdown-menu dropdown-with-icons text-center">
                    <form method="GET" action="<?=Text::URL;?>/products" class="navbar-form form-inline">
                       <input style="margin-left:8px;" type="text" class="form-control mb-2 mr-sm-2" id="searchinput" name="search" placeholder="Product zoeken...">
                       <button type="submit" class="btn btn-primary mb-2">Zoeken</button>
                    </form>
               </div>
            </li>
            <form method="GET" action="<?=Text::URL;?>/products" class="form-inline ml-auto d-block d-lg-none d-xl-none">
               <div class="form-group no-border">
                  <input name="search" type="text" class="form-control" placeholder="Zoeken...">
               </div>
               <button type="submit" class="btn btn-white btn-just-icon btn-round">
                  <i class="material-icons">search</i>
               </button>
            </form>
            <li class="button-container nav-item mr-1">
               <a href="<?=Text::URL;?>/cart/" class="btn btn-primary btn-round btn-block">
                   <i class="material-icons">shopping_cart</i>
                   <span class="navbar-cart-amount"><?=$cart->getProductCount();?></span>
               </a>
            </li>
            <li class="button-container nav-item">
               <a data-toggle="modal" data-target="#loginModal" href="" class="btn btn-rose btn-round btn-block">
               <i class="fa fa-sign-in"></i>
               Login
               </a>
            </li>
         </ul>
      </div>
   </div>
</nav>