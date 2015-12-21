<!doctype html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="msapplication-tap-highlight" content="no">
   <meta name="description" content="Astrid Garth">
   <title><?= $data['title'] . ' - ' . SITETITLE ?></title>
   <link rel="shortcut icon" href="http://www.astrid-garth.de//bilder/favicon.ico"/>
   <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="<?= URL::MATERIALIZE('materialize','css') ?>" media="screen,projection"/>
   <!-- Let browser know website is optimized for mobile -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <!-- Material font -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <!-- Materialize style -->
   <link href="<?= URL::MATERIALIZE('style','css') ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
   <!--Import jQuery before materialize.js-->
   <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
   <!--  Android 5 Chrome Color-->
   <meta name="theme-color" content="#EE6E73">
</head>
<body>
    <div align="center" class="margin-auto">
     <a href="<?= DIR ?>">
       <img style="width:250px;height:70px;"  class="logo-media" src="<?= URL::ASSETS('black-logo.png','logo') ?>">
     </a>
   </div>
    <nav class="black" role="navigation">
      <div class="container">
        <div class="nav-wrapper">
          <a href="<?= DIR ?>">
            <img style="width:250px;height:70px;" class="logo-media-grey hide-on-med-and-down" src="<?= URL::ASSETS('grey-logo.png','logo') ?>">
          </a>
         <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
         <!-- menu for screen with width above 992px -->
         <div class="right hide-on-med-and-down shown">
           <div class="row">
               <ul class="ul_menu">
                 <li class="col s2 deskt"><a class="active" href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
                 <li class="col s2 deskt"><a href="<?= DIR ?>vita">VITA</a></li>
                 <li class="col s2 deskt"><a href="<?= DIR ?>referenzen">REFERENZEN</a></li>
                 <li class="col s2 deskt"><a href="<?= DIR ?>links">LINKS</a></li>
                 <li class="col s2 deskt"><a href="<?= DIR ?>kontakt">KONTAKT</a></li>
                 <li class="col s2 deskt"><a href="<?= DIR ?>impressum">IMPRESSUM</a></li>
               </ul>
           </div>
         </div>
         <!-- menu for screen max-width 992px -->
         <div class="hide-on-large-only hide-on-small-only middle">
           <div class="row">
             <div class="col s12">
               <ul class="ul_menu">
                 <li class="col s2"><a class="active" href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
                 <li class="col s2"><a href="<?= DIR ?>vita">VITA</a></li>
                 <li class="col s2"><a href="<?= DIR ?>referenzen">REFERENZEN</a></li>
                 <li class="col s2"><a href="<?= DIR ?>links">LINKS</a></li>
                 <li class="col s2"><a href="<?= DIR ?>kontakt">KONTAKT</a></li>
                 <li class="col s2"><a href="<?= DIR ?>impressum">IMPRESSUM</a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </div> <!-- container -->

     <div class="nav-wrapper">
      <!-- menu for screen max-width 600px -->
      <ul class="side-nav" id="mobile-demo">
        <li><a class="active" href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
        <li><a href="<?= DIR ?>vita">VITA</a></li>
        <li><a href="<?= DIR ?>referenzen">REFERENZEN</a></li>
        <li><a href="<?= DIR ?>links">LINKS</a></li>
        <li><a href="<?= DIR ?>kontakt">KONTAKT</a></li>
        <li><a href="<?= DIR ?>impressum">IMPRESSUM</a></li>
      </ul>
    </div>
 </nav>
