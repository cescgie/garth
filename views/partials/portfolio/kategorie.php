<div class="row">
    <?php echo Message::show(); ?>
    <?php if(SESSION::get('admin')) :?>
    <a class="modal-trigger-newKategorie waves-effect waves-light btn btn-navigator" style="background-color:#40c4ff" href="#modalNewKategorie">Neue Kategorie erstellen</a><br><br>
    <div id="modalNewKategorie" class="modal">
      <div class="modal-content">
        <form action="<?php DIR ?>/portfolio/createKategorie/<?=$data['cat_id']?>" method="POST">
          <div class="row input-field">
            <div class="col s12">
              <div id="div_album_name">
                <input placeholder="Neue Kategorie" id="new_album_name" name="new_album_name" type="text">
                <input type="hidden" name="ober_kategorie_name" value="<?=$data['kategorie_name'] ?>">
              </div>
            </div>
            <input type="submit" class="right btn submit" value="Erstellen">
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>
    <?php if(!sizeof($data['albums'])) :?>
      <p>No Data</p>
    <?php else:?>
       <?php
       $i=1;
       foreach ($data['albums'] as $key => $value) :?>
        <div class="col s12 m4 l3">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light index-image">
                <a  href="<?= DIR ?>portfolio/album?album=<?= $value['name'];?>&kategorie=<?= $data['kategorie_name'];?>">
                <!--<a id="kategorie<?= $value['id'];?>" href="javascript:void(0)">-->
                  <?php if($value['image']==NULL):?>
                    <img style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR ?>assets/img/background1.jpg">
                  <?php else:?>
                    <img style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= $value['image'];?>">
                  <?php endif;?>
                </a>
              </div>
              <div class="card-content">
                <p class="center activator grey-text text-darken-4 "><?= ucwords($value['name']); ?></p>
                <?php if(SESSION::get('admin')) :?>
                  <a class="modal-trigger-editKategorie waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5" href="#modal<?=$value['id']?>">Edit</a>
                  <a class="modal-trigger-deleteKategorie waves-effect waves-light btn btn-navigator" style="background-color:#ff5252" href="#modalDeleteKategorie<?=$value['id']?>">Delete</a>
                <?php endif; ?>
              </div>
          </div>
        </div>
        <?php if(SESSION::get('admin')):?>
          <!-- Modal Structure -->
          <div id="modal<?=$value['id']?>" class="modal">
            <div class="modal-content">
              <h4><?= ucwords($value['name']); ?></h4>
              <form id="form" action="<?= DIR ?>portfolio/editKategorie/<?=$value['id']?>" enctype="multipart/form-data" method="post">
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?= ucwords($value['name']);?>" id="name" name="name" type="text" class="validate">
                    <label class="active" for="title">Name</label>
                  </div>
                  <div class="file-field col s12">
                    <div style="margin-bottom:20px;margin-left:10px;">
                      <input type="checkbox" name="newcover<?=$value['id']?>" id="newcover<?=$value['id']?>"/>
                      <label for="newcover<?=$value['id']?>">Neues Cover</label>
                    </div>
                    <script type="text/javascript">
                    //trigger newcover
                    $("#newcover<?=$value['id']?>").change(function() {
                        var newcover = $('#newcover<?=$value['id']?>').is(':checked');
                        if(newcover==true){
                          //remove it
                          $('#kategorie_cover<?=$value['id']?>').removeAttr("disabled");
                          $('#cover-btn<?=$value['id']?>').css('background-color','')
                        }else{
                          //add disabled
                          $('#kategorie_cover<?=$value['id']?>').attr('disabled', 'disabled');
                          $('#cover-btn<?=$value['id']?>').css('background-color','#9e9e9e')
                        }
                        console.log(newcover);
                    });
                    </script>
                  </div>
                  <div class="file-field col s12">
                    <div id="cover-btn<?=$value['id']?>" class="btn" style="background-color:#9e9e9e;">
                      <span>Cover</span>
                      <input type="file" id="kategorie_cover<?=$value['id']?>" name="kategorie_cover<?=$value['id']?>" disabled>
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

          <!-- Modal Delete Structure -->
          <div id="modalDeleteKategorie<?= $value['id'];?>" class="modal">
            <div class="modal-content">
              <p>Delete <?= $value['name'];?>?</p>
            </div>
            <div class="modal-footer">
              <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat right">Nein</a>
              <a href="<?= DIR.'portfolio/deleteKategorie/'.$value['id']?>" class="modal-action modal-close waves-effect waves-green btn-flat">Ja</a>
            </div>
          </div>
        <?php endif;?>
      <?php;endforeach; ?>
    <?php endif;?>
</div>

<script type="text/javascript">
$(document).ready(function(){
  //trigger modal
  $('.modal-trigger-editKategorie').leanModal();
  $('.modal-trigger-deleteKategorie').leanModal();
  $('.modal-trigger-newKategorie').leanModal();
});
$('a#editForm').click(function(){
  console.log($(this).attr('album_id'));
  $('#formEdit').show();
});
$('#closeForm').click(function(){
  $('#formEdit').hide();
});
</script>
