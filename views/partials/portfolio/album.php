<div class="row">
    <?php if(!sizeof($data['images'])) :?>
      <p>No Data</p>
    <?php else:?>
      <?php foreach($data['images']as $key=>$value): ?>
      <div class="col s12 m6 l6 foto_album">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light hoverable">
            <a href="<?php DIR ?>show?album_id=<?= $value['album_id'];?>&kategorie_id=<?= $value['kategorie_id'];?>&reihenfolge=<?= $value['reihenfolge'];?>">
              <img class="responsive-img hoverable z-depth-3 activator" data-caption="A picture of some deer and tons of trees" width="100%" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
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
    <?php endif;?>
</div>

  <script type="text/javascript">
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
