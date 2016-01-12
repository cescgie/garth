<!doctype html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta http-equiv="content-language" content="de"/>
   <meta name="msapplication-tap-highlight" content="no">
   <meta name="author" content="Astrid Garth"/>
   <meta name="robots" content="all"/>
   <meta name="description" content="Astrid Garth"/>
   <meta name="keywords" lang="de" content="<?= $data['meta'];?>"/>
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
   <!-- Own style -->
   <link type="text/css" href="<?= URL::EXTRAS('style','css')?>" media="screen">
   <link rel="stylesheet" href="<?= URL::COLORBOX('example5/colorbox','css')?>" media="screen" title="no title" charset="utf-8">
   <script type="text/javascript" src="<?= URL::COLORBOX('jquery.colorbox','js')?>"></script>
   </head>
<body>
    <div align="center" class="margin-auto">
     <a href="<?= DIR ?>">
       <img style="width:250px;height:70px;" onmouseover="this.src='<?= URL::ASSETS('grey2-logo.png','logo') ?>';" onmouseout="this.src='<?= URL::ASSETS('black-logo.png','logo') ?>';" class="logo-media" src="<?= URL::ASSETS('black-logo.png','logo') ?>">
     </a>
   </div>
    <nav role="navigation" style="background-color:#333333">
      <div class="container">
        <div class="nav-wrapper">
          <a href="<?= DIR ?>">
            <img style="width:250px;height:70px;" class="logo-media-grey hide-on-med-and-down" src="<?= URL::ASSETS('grey-logo.png','logo') ?>"  onmouseover="this.src='<?= URL::ASSETS('grey2-logo.png','logo') ?>';" onmouseout="this.src='<?= URL::ASSETS('grey-logo.png','logo') ?>';" >
          </a>
         <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
         <!-- menu for screen with width above 992px -->
         <div class="right hide-on-med-and-down shown">
           <div class="row">
               <ul class="ul_menu">
                 <li class="col s2 deskt"><a <?php if($data['menu_active'] === 'portfolio'):?>class="active"<?php endif;?> href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
                 <li class="col s2 deskt"><a <?php if($data['menu_active'] === 'vita'):?>class="active"<?php endif;?> href="<?= DIR ?>vita">VITA</a></li>
                 <li class="col s2 deskt"><a <?php if($data['menu_active'] === 'referenzen'):?>class="active"<?php endif;?> href="<?= DIR ?>referenzen">REFERENZEN</a></li>
                 <li class="col s2 deskt"><a <?php if($data['menu_active'] === 'links'):?>class="active"<?php endif;?> href="<?= DIR ?>links">LINKS</a></li>
                 <li class="col s2 deskt"><a <?php if($data['menu_active'] === 'kontakt'):?>class="active"<?php endif;?> href="<?= DIR ?>kontakt">KONTAKT</a></li>
               </ul>
           </div>
         </div>
         <!-- menu for screen max-width 992px -->
         <div class="hide-on-large-only hide-on-small-only middle">
           <div class="row">
             <div class="col s12">
               <ul class="ul_menu">
                 <li class="col s2 medium"><a <?php if($data['menu_active'] === 'portfolio'):?>class="active"<?php endif;?> href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
                 <li class="col s2 medium"><a <?php if($data['menu_active'] === 'vita'):?>class="active"<?php endif;?> href="<?= DIR ?>vita">VITA</a></li>
                 <li class="col s2 medium"><a <?php if($data['menu_active'] === 'referenzen'):?>class="active"<?php endif;?> href="<?= DIR ?>referenzen">REFERENZEN</a></li>
                 <li class="col s2 medium"><a <?php if($data['menu_active'] === 'links'):?>class="active"<?php endif;?> href="<?= DIR ?>links">LINKS</a></li>
                 <li class="col s2 medium"><a <?php if($data['menu_active'] === 'kontakt'):?>class="active"<?php endif;?> href="<?= DIR ?>kontakt">KONTAKT</a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </div> <!-- container -->

     <div class="nav-wrapper">
      <!-- menu for screen max-width 600px -->
      <ul class="side-nav ul_menu" id="mobile-demo">
        <li class="col s2"><a <?php if($data['menu_active'] === 'portfolio'):?>class="active"<?php endif;?> href="<?= DIR ?>portfolio">PORTFOLIO</a></li>
        <li class="col s2"><a <?php if($data['menu_active'] === 'vita'):?>class="active"<?php endif;?> href="<?= DIR ?>vita">VITA</a></li>
        <li class="col s2"><a <?php if($data['menu_active'] === 'referenzen'):?>class="active"<?php endif;?> href="<?= DIR ?>referenzen">REFERENZEN</a></li>
        <li class="col s2"><a <?php if($data['menu_active'] === 'links'):?>class="active"<?php endif;?> href="<?= DIR ?>links">LINKS</a></li>
        <li class="col s2"><a <?php if($data['menu_active'] === 'kontakt'):?>class="active"<?php endif;?> href="<?= DIR ?>kontakt">KONTAKT</a></li>
      </ul>
    </div>
 </nav>
