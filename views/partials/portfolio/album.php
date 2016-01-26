<div class="row">
    <?php echo Message::show(); ?>
    <?php if(SESSION::get('admin')) :?>
    <a class="modal-trigger-newBilder waves-effect waves-light btn btn-navigator" style="background-color:#40c4ff" href="#modalNewBilder">Neue Bilder hochladen</a><br><br>
    <div id="modalNewBilder" class="modal">
      <div class="modal-content">
        <form action="<?= DIR ?>portfolio/uploadBilder" method="POST" enctype="multipart/form-data">
          <div class="row input-field">
            <div class="file-field col s12">
               <input type="hidden" name="album_id" value="<?=$data['id_album']?>">
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
    <?php endif; ?>
    <?php if(!sizeof($data['images'])) :?>
      <p>No Data</p>
    <?php else:?>
      <?php if(SESSION::get('admin')) :?>
      <a id="editreihenfolge" class="waves-effect waves-light btn btn-navigator" style="background-color:#4db6ac;" href="#">Reihenfolge aktualisieren</a><br><br>
      <?php endif;?>
      <?php foreach($data['images']as $key=>$value): ?>
      <div class="col s12 m4 l3 foto_album">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light album-image">
            <a class="group4"  title="<?= $value['title']?>" href="<?= DIR.$value['path'];?>">
              <img style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3 activator" src="<?= DIR.$value['cover'];?>">
            </a>
          </div>
          <div class="card-content">
            <a href="<?php DIR ?>show?album_id=<?= $value['album_id'];?>&kategorie_id=<?= $value['kategorie_id'];?>&reihenfolge=<?= $value['reihenfolge'];?>">
              <p class="center activator grey-text text-darken-4 "><?= ucfirst($value['title']); ?></p>
            </a>
            <?php if(SESSION::get('admin')) :?>
              <a class="modal-trigger-Image waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5" href="#modalEdit<?= $value['id'];?>">Edit</a>
              <a class="modal-trigger-Image waves-effect waves-light btn btn-navigator" style="background-color:#ff5252;" href="#modalDelete<?= $value['id'];?>">Delete</a>
              <!-- Modal Edit Structure -->
              <div id="modalEdit<?= $value['id'];?>" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <h4>Edit <?= $value['title'];?></h4>
                  <form id="form<?= $value['id'];?>">
                    <div class="row">
                      <div class="input-field col s12">
                        <input value="<?= $value['title'];?>" id="title-<?= $value['id'];?>" type="text" class="validate">
                        <label class="active" for="title">Title</label>
                      </div>
                      <div class="input-field col s12">
                        <input value="<?= $value['keywords'];?>" id="keywords-<?= $value['id'];?>" type="text" class="validate">
                        <label class="active" for="keywords">Keywords</label>
                      </div>
                      <div class="input-field col s12">
                        <textarea id="description-<?= $value['id'];?>" class="materialize-textarea"><?= $value['description'];?></textarea>
                        <label for="description">Description</label>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <a href="javascript:edit(<?= $value['id'];?>)" class="modal-action modal-close waves-effect waves-green btn">Aktualisieren</a>
                </div>
              </div>

              <!-- Modal Delete Structure -->
              <div id="modalDelete<?= $value['id'];?>" class="modal">
                <div class="modal-content">
                  <p>Delete <?= $value['title'];?>?</p>
                </div>
                <div class="modal-footer">
                  <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat right">Nein</a>
                  <a href="javascript:confirmDelete(<?= $value['id'];?>,<?= $value['album_id'];?>)" class="modal-action modal-close waves-effect waves-green btn-flat">Ja</a>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if(SESSION::get('admin')) :?>
        <div class="container center-align div_sortable" style="display:none">
          <div class="col s12 m12 l12">
            <a class="modal-trigger-reihenfolge waves-effect waves-light btn btn-navigator right" href="#modalUpdateRF" style="background-color:#4db6ac;">Speichern</a><br><br>
            <!-- Modal Delete Structure -->
            <div id="modalUpdateRF" class="modal">
              <div class="modal-content">
                <p>Die aktualle Reihenfolge speichern?</p>
              </div>
              <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat right">Nein</a>
                <a id="speichernRH" href="#"class="modal-action modal-close waves-effect waves-green btn-flat">Ja</a>
              </div>
            </div>
            <ul class="list_bilder" id="sortable">
              <?php
                $i = 1;
                foreach($data['images']as $key=>$value): ?>
                  <li class="ui-state-default">
                    <img src="<?= DIR.$value['cover'];?>" style="width:10%" alt="" />
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span id="title" style="font-size:0.75em;;"><?=$i?> <?= $value['title'];?></span>
                    <input type="hidden" name="old_id" class="old_id" value="<?= $value['reihenfolge'];?>">
                    <input type="hidden" name="in_id" class="in_id" value="<?= $value['id'];?>">
                  </li>
              <?php
              $i++;
            endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif;?>
    <?php endif;?>
</div>
  <!-- COLORBOX trigger -->
  <script>
   $(document).ready(function(){
     $(".group4").colorbox({rel:'group4', slideshow:true});
     jQuery.colorbox.settings.maxWidth  = '90%';
     jQuery.colorbox.settings.maxHeight = '90%';

      // ColorBox resize function, seems do work now
      var resizeTimer;
      $(window).resize(function(){
        if (resizeTimer) clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function() {
          if ($('#cboxOverlay').is(':visible')) {
            //reload ist selbst hinugefügt in colorbox.js, public func welche einfach nur load() aufruft
            $.colorbox.reload();
          }
        }, 300)
      });

   });
  </script>
  <?php if(SESSION::get('admin')) :?>
  <script type="text/javascript">
    $(document).ready(function(){
      //trigger modal
      $('.modal-trigger-newBilder').leanModal();
    });
   function confirmDelete(id,album_id){
     console.log("id : "+album_id);
     $.ajax({
        type: 'POST',
        data: {
              id: id,
              album_id:album_id
        },
        url: <?php DIR ?>'delete',
        dataType: "json",
        success: function (data){
          console.log(data);
          window.location.reload(true);
        },
        error: function(data) {
          console.log("error");
        }
      });
   }

   function edit(id){
     $.ajax({
       type: 'POST',
       data: {
          id: id,
          title: $('#title-'+id).val(),
          keywords: $('#keywords-'+id).val(),
          description: $('#description-'+id).val()
       },
       url: <?php DIR ?>'edit',
       dataType: "json",
       success: function (data){
         console.log(data);
         window.location.reload(true);
       },
       error: function(data) {
         console.log("error");
       }
      });
   }

  </script>
<script type="text/javascript">
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  $(document).on('click','#editreihenfolge',function(){
    console.log('editreihenfolge');
    $(".foto_album").toggle();
    $(".div_sortable").toggle();
  });
  $(document).on('click','#speichernRH',function(){
    console.log('speichernRH');
    var item = [];
    $('.list_bilder li input.old_id').each(function (i, e) {
        item.push($(e).val());
    });
    var item2 = [];
    $('.list_bilder li input.in_id').each(function (i, e) {
        item2.push($(e).val());
    });
    var strfy = [];
    for (var i = 0; i < item.length; i++) {
      $.ajax({
        type: "POST",
        url: "update_reihenfolge",
        data: { id : item2[i], reihenfolge : i+1},
        dataType: "html",
        success: function(response){
          console.log('success');
        }
      });
    }
    Materialize.toast('Reihenfolge aktualisiert', 2500, '',function(){location.reload()});
  });
</script>
<?php endif;?>
