<div class="row">
  <?php echo Message::show(); ?>
  <?php if(SESSION::get('admin')) :?>
    <a id="editreihenfolge" class="waves-effect waves-light btn btn-navigator" style="background-color:#4db6ac;" href="#">Reihenfolge aktualisieren</a><br><br>
    <a class="modal-trigger-newOberkategorie waves-effect waves-light btn btn-navigator" style="background-color:#40c4ff" href="#modalNewOberkategorie">Neue Oberkategorie erstellen</a><br><br>
    <div id="modalNewOberkategorie" class="modal">
      <div class="modal-content">
        <form action="<?=DIR?>portfolio/createOberkategorie" method="POST">
          <div class="row input-field">
            <div class="col s12">
              <div id="div_ober_name">
                <input placeholder="Neue Oberkategorie" id="ober_kategorie_id" name="ober_kategorie_name" type="text">
              </div>
            </div>
            <input type="submit" class="right btn submit" value="Erstellen">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>
  <?php foreach ($data['kategories'] as $key => $value) :?>
    <div class="col s12 m4 l3 kategorie_list">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light index-image">
          <a href="<?= DIR ?>portfolio/kategorie/<?= $value['slug'];?>">
            <!-- <center><img style="border-color:white;width:95%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR ?>assets/portfolio/<?= ucfirst($value['name']);?>.jpg"></center> -->
            <?php if($value['image']==NULL):?>
              <center><img alt="<?= str_replace('_',' ',$value['name'])?>" style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR ?>assets/img/background1.jpg"></center>
            <?php elseif($value['image_form']==1):?>
              <img alt="<?= str_replace('_',' ',$value['name'])?>" style="border-color:white;width:65%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR.$value['image'];?>">
            <?php else:?>
              <img alt="<?= str_replace('_',' ',$value['name'])?>" style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR.$value['image'];?>">
            <?php endif;?>
          </a>
        </div>
        <div class="card-content">
          <p class="truncate center activator grey-text text-darken-4 title-mouse"><?= str_replace('_',' ',$value['name']); ?></p>
          <?php if(SESSION::get('admin')) :?>
            <a class="modal-trigger-editOberkategorie waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5" href="#modal-OberkategorieEdit-<?=$value['id']?>">Edit</a>
            <a class="modal-trigger-deleteOberkategorie waves-effect waves-light btn btn-navigator" style="background-color:#ff5252" href="#modalDeleteOberkategorie<?=$value['id']?>">Delete</a>
          <?php endif; ?>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-1"><?= str_replace('_',' ',$value['name']); ?><i class="material-icons right">close</i></span>
          <p class="grey-text text-darken-4"><?= $value['description'] ?></p>
        </div>
      </div>
    </div>
    <?php if(SESSION::get('admin')):?>
      <!-- Modal Delete Structure -->
            <div id="modalDeleteOberkategorie<?= $value['id'];?>" class="modal">
              <div class="modal-content">
                <p>Oberkategorie '<?= $value['name'];?>' löschen?</p>
                <p>Alle Dateien in dieser Oberkategorie werden auch gelöscht!</p>
              </div>
              <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat right">Nein</a>
                <a href="<?= DIR.'portfolio/deleteOberkategorie/'.$value['id']?>" class="modal-action modal-close waves-effect waves-green btn-flat">Ja</a>
              </div>
            </div>

            <!-- Modal Edit Structure -->
            <div id="modal-OberkategorieEdit-<?=$value['id']?>" class="modal">
              <div class="modal-content">
                <h4><?= str_replace('_',' ',$value['name']); ?></h4>
                <form id="form" action="<?= DIR ?>portfolio/editOberkategorie/<?=$value['id']?>" enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="input-field col s12">
                      <input value="<?= str_replace('_',' ',$value['name']);?>" id="name" name="name" type="text" class="validate">
                      <label class="active" for="title">Title</label>
                    </div>
                    <div class="input-field col s12">
                      <textarea id="description-<?= $value['id'];?>" id="description" name="description" class="materialize-textarea"><?= $value['description'];?></textarea>
                      <label for="description">Description</label>
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
                            $('#Oberkategorie_cover<?=$value['id']?>').removeAttr("disabled");
                            $('#cover-btn<?=$value['id']?>').css('background-color','')
                          }else{
                            //add disabled
                            $('#Oberkategorie_cover<?=$value['id']?>').attr('disabled', 'disabled');
                            $('#cover-btn<?=$value['id']?>').css('background-color','#9e9e9e')
                          }
                          console.log(newcover);
                      });
                      </script>
                    </div>
                    <div class="file-field col s12">
                      <div id="cover-btn<?=$value['id']?>" class="btn" style="background-color:#9e9e9e;">
                        <span>Cover</span>
                        <input type="file" id="Oberkategorie_cover<?=$value['id']?>" name="Oberkategorie_cover<?=$value['id']?>" disabled>
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

          <?php endif;?>
  <? endforeach;?>
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
            foreach($data['kategories']as $key=>$value): ?>
              <li class="ui-state-default">
                <?php if($value['image']==NULL):?>
                  <img style="width:10%;" src="<?= DIR ?>assets/img/background1.jpg">
                <?php else:?>
                  <img src="<?= DIR.$value['image'];?>" style="width:10%;"/>
                <?php endif;?>
                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span id="title" style="font-size:0.75em;"><?=$i?> <?= str_replace('_',' ',$value['name']);?></span>
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
</div>
<?php if(SESSION::get('admin')) :?>

<script type="text/javascript">
$(document).ready(function(){
  //trigger modal
  $('.modal-trigger-editOberkategorie').leanModal();
  $('.modal-trigger-deleteOberkategorie').leanModal();
  $('.modal-trigger-newOberkategorie').leanModal();

  //Edit Reihenfolge
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  $(document).on('click','#editreihenfolge',function(){
    console.log('editreihenfolge');
    $(".kategorie_list").toggle();
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
        url: <?php DIR ?>'portfolio/update_reihenfolge',
        data: { id : item2[i], reihenfolge : i+1, table:'kategories'},
        dataType: "html",
        success: function(response){
          console.log('success');
        }
      });
    }
    Materialize.toast('Reihenfolge aktualisiert', 2500, '',function(){location.reload();});
  });
});
</script>
<?php endif;?>
