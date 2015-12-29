<?php if(SESSION::get('admin')){?>
<div class="widget-upload" id="formEdit" style="display:none">
  <div class="inside">
    <a href="#" class="right" id="closeForm">Close(x)</a>
    <form id="form" action="<?= DIR ?>portfolio/editKategorie" enctype="multipart/form-data">
      <div class="row">
        <div class="input-field col s12">
          <input value="" id="name" type="text" class="validate">
          <label class="active" for="title">Name</label>
        </div>
        <div class="input-field col s12">
          <input value="" id="keywords" type="text" class="validate">
          <label class="active" for="keywords">Keywords</label>
        </div>
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea"></textarea>
          <label for="description">Description</label>
        </div>
        <div class="file-field col s12">
          <div class="btn">
            <span>Datei</span>
            <input type="file" id="kategorie_cover" name="kategorie_cover">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Cover hochladen">
          </div>
        </div>
        <input type="submit" class="right btn submit" value="Aktualisieren">
      </div>
    </form>
  </div>
</div>
<?php }?>
<div class="row">
    <?php if(!sizeof($data['albums'])) :?>
      <p>No Data</p>
    <?php else:?>
       <?php
       $i=1;
       foreach ($data['albums'] as $key => $value) :?>
        <div class="col s12 m6">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light hoverable">
                <a href="<?= DIR ?>portfolio/album?album=<?= $value['name'];?>&kategorie=<?= $data['kategorie_name'];?>">
                  <img src="<?= DIR ?>assets/img/background<?=$i++?>.jpg">
                </a>
              </div>
              <div class="card-content">
                <p class="center activator grey-text text-darken-4 "><?= ucfirst($value['name']); ?></p>
                <?php if(SESSION::get('admin')) :?>
                  <a id="editForm" class="waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5" href="#modalEditKategorie<?= $value['id'];?>">Edit</a>
                <?php endif; ?>
              </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif;?>
</div>
<script type="text/javascript">
$('a#editForm').click(function(){
  console.log($(this).attr('album_id'));
  $('#formEdit').show();
});
$('#closeForm').click(function(){
  $('#formEdit').hide();
});
</script>
