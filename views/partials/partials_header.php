<!-- Menu -->
<div id="index-banner" class="partial">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="widget-header header-color-black">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="bigger h4-div h4-a">
              <?php if(strtolower($data['subtitle'])=='portfolio') {?>
                 <a href="<?= DIR.strtolower($data['subtitle']);?>"><?php echo $data['subtitle'];?></a>
               <?php }else{?>
                 <?php echo $data['subtitle'];?>
               <?php }?>
            </h4>
          </div>
        </div>
      </div>
      <div class="widget-body">
