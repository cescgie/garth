<!-- Menu -->
<div id="index-banner" class="partial">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="widget-header header-color-black">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="bigger h4-div h4-a">
              <?php if($data['subtitle'] != '' && $data['subtitle'] == 'portfolio') {?>
                 <a href="<?= DIR.$data['subtitle'];?>"><?php echo strtoupper($data['subtitle']);?></a>
                 <?php if($data['kategorie'] != '') {?>
                   <span class="span_submenu">Kategorie</span>
                  | <a href="<?= DIR.$data['subtitle'].'/kategorie/'.$data['kategorie'];?>"><?php echo strtoupper($data['kategorie']);?></a>
                  <?php if($data['album'] != '') {?>
                    <span class="span_submenu">Album</span>
                    | <a href="<?= DIR.$data['subtitle'].'/album?album='.$data['album'].'&kategorie='.$data['kategorie'];?>"><?php echo strtoupper($data['album']);?></a>
                  <?php }
                  }?>
               <?php }else{?>
                 <?php echo $data['subtitle'];?>
               <?php }?>
            </h4>
          </div>
        </div>
      </div>
      <div class="widget-body">
