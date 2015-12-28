<div class="widget-upload">
  <div class="inside">
    <p>Neues Bild hochladen</p>
    <form action="<?php DIR ?>portfolio/upload" method="POST" enctype="multipart/form-data">

  <div class="row input-field">
    <div class="col s12" style="margin-bottom:20px;">
      <input type="checkbox" name="newalbum" id="newalbum"/>
      <label for="newalbum">Neue kategorie</label>
    </div>

    <div class="col s12">
      <div id="div_album_name" style="display:none">
        <input placeholder="Neue Kategorie" id="new_album_name" name="new_album_name" type="text">
        <select id="choose_kategorie" name="kategorie_name">
          <option value="" >Oberkategorie auswählen</option>
          <?php foreach($data['kategories']as $key=>$value): ?>
            <option value="<?= $value['name'];?>"><?= ucfirst($value['name']);?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div id="div_choose_album">
        <select id="choose_album" name="album_name">
          <option value="" >Kategorie auswählen</option>
          <?php foreach($data['albums']as $key=>$value): ?>
            <option value="<?= $value['name'];?>"><?= ucfirst($value['name']);?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="file-field col s12">
      <div class="btn">
        <span>Datei</span>
        <input type="file" name="images[]" multiple="">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Ein oder mehr Bilder hochladen">
      </div>
    </div>

    <input type="submit" class="right btn submit" value="Hochladen">

  </div>
</form>

</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    //trigger newalbum
    $("#newalbum").change(function() {
        var newalbum = $('#newalbum').is(':checked');
        if(newalbum==true){
          console.log(newalbum);
          $('#div_album_name').show();
          $('#div_choose_album').hide();
        }else{
          console.log(newalbum);
          $('#div_album_name').hide();
          $('#div_choose_album').show();
        }
    });
    //select album
    $(document).ready(function() {
      $('select').material_select();
    });
  });
</script>
