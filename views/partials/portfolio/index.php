<div class="widget-upload">
  <div class="inside">
    <p>Upload New Image</p>
    <form action="<?php DIR ?>portfolio/upload" method="POST" enctype="multipart/form-data">

      <div class="row input-field">
        <div class="col s12" style="margin-bottom:20px;">
          <input type="checkbox" name="newalbum" id="newalbum"/>
          <label for="newalbum">New Album</label>
        </div>

        <div class="col s12">
          <div id="div_album_name" style="display:none">
            <input placeholder="Album Name" id="new_album_name" name="new_album_name" type="text">
            <select id="choose_kategorie" name="kategorie_name">
              <option value="" >Choose kategorie</option>
              <?php foreach($data['kategories']as $key=>$value): ?>
                <option value="<?= $value['name'];?>"><?= ucfirst($value['name']);?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div id="div_choose_album">
            <select id="choose_album" name="album_name">
              <option value="" >Choose album</option>
              <?php foreach($data['albums']as $key=>$value): ?>
                <option value="<?= $value['name'];?>"><?= ucfirst($value['name']);?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="file-field col s12">
          <div class="btn">
            <span>File</span>
            <input type="file" name="images[]" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
          </div>
        </div>

        <input type="submit" class="right btn submit" value="Upload">

      </div>
    </form>
  </div>
</div>
  <p>
    To make images resize responsively to page width, you can add the class responsive-img to your image tag. It will now have a max-width: 100% and height:auto.
  </p>
  <img class="materialboxed responsive-img" data-caption="A picture of some deer and tons of trees" width="250" src="http://th01.deviantart.net/fs70/PRE/i/2013/126/1/e/nature_portrait_by_pw_fotografie-d63tx0n.jpg">

<script type="text/javascript">
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() {
        console.log('Ready');
      }, // Callback for Modal open
      complete: function() {
        console.log('Closed');
      } // Callback for Modal close
    });

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
