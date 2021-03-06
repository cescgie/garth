<div class="row">
    <?php echo Message::show(); ?>
    <?php if(SESSION::get('admin')) :?>
    <a id="editreihenfolge" class="waves-effect waves-light btn btn-navigator" style="background-color:#4db6ac;" href="#">Reihenfolge aktualisieren</a><br><br>
    <a class="modal-trigger-newKategorie waves-effect waves-light btn btn-navigator" style="background-color:#40c4ff" href="#modalNewKategorie">Neue Kategorie erstellen</a><br><br>
    <div id="modalNewKategorie" class="modal">
      <div class="modal-content">
        <form action="<?=DIR?>portfolio/createKategorie/<?=$data['cat_id']?>" method="POST">
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
        <div class="col s12 m4 l3 album_list">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light kategorie-image">
                <!-- <a  href="<?= DIR ?>portfolio/album?album=<?= $value['name'];?>&kategorie=<?= str_replace('_',' ',$data['kategorie_name']);?>"> -->
                <!-- <a id="kategorie<?= $value['id'];?>" href="javascript:void(0)"> -->
                <a href="<?= DIR ?>portfolio/album/<?= $value['slug'];?>">
                  <?php if($value['image']==NULL):?>
                    <img alt="<?= str_replace('_',' ',$value['name'])?>" style="border-color:white;width:90%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR ?>assets/img/background1.jpg">
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
                  <a class="modal-trigger-editKategorie waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5" href="#modal<?=$value['id']?>">Edit</a>
                  <a class="modal-trigger-deleteKategorie waves-effect waves-light btn btn-navigator" style="background-color:#ff5252" href="#modalDeleteKategorie<?=$value['id']?>">Delete</a>
                <?php endif; ?>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-1"><?= str_replace('_',' ',$value['name']); ?><i class="material-icons right">close</i></span>
                <p class="grey-text text-darken-4"><?= $value['description'] ?></p>
              </div>
          </div>
        </div>
		<script type="text/javascript">
        	$(document).ready(function() {
            $("#kategorie<?= $value['id'];?>").click(function() {
              var album_id = <?= $value['id'];?>;
              var kategorie_id = <?= $value['kategorie_id'];?>;
              $.ajax({
                 type: 'POST',
                 data: {
                       album_id: album_id,
                       kategorie_id:kategorie_id,
                 },
                 url: <?php DIR ?>'/test/portfolio/shows',
                 dataType: "json",
                 success: function (data){
                   if(data!=''){
                     var shows = JSON.stringify(data);
                     $.fancybox(
                       data
                 		  , {
                 			'padding'			: 0,
                 			'transitionIn'		: 'none',
                 			'transitionOut'		: 'none',
                 			'type'              : 'image',
                 			'changeFade'        : 0
                 		});
                  }else{
                    $.fancybox({
                      'padding'		: 0,
                			'href'			: 'http://vignette4.wikia.nocookie.net/dofus/images/c/c8/Kein_Bild.png',
                      'title'     : 'kein Bild vorhanden',
                			'transitionIn'	: 'elastic',
                			'transitionOut'	: 'elastic'
	                  });
                  }
                 },
                 error: function(data) {
                   console.log("error");
                 }
               });
          	});
        	});
        </script>
        <?php if(SESSION::get('admin')):?>
          <!-- Modal Structure -->
          <div id="modal<?=$value['id']?>" class="modal">
            <div class="modal-content">
              <h4><?= str_replace('_',' ',$value['name']); ?></h4>
              <form id="form" action="<?= DIR ?>portfolio/editKategorie/<?=$value['id']?>" enctype="multipart/form-data" method="post">
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?= str_replace('_',' ',$value['name']);?>" id="name" name="name" type="text" class="validate">
                    <label class="active" for="title">Name</label>
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
              foreach($data['albums']as $key=>$value): ?>
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

//Edit Reihenfolge
$(function() {
  $( "#sortable" ).sortable();
  $( "#sortable" ).disableSelection();
});

$(document).on('click','#editreihenfolge',function(){
  console.log('editreihenfolge');
  $(".album_list").toggle();
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
      url: <?php DIR ?>'../update_reihenfolge',
      data: { id : item2[i], reihenfolge : i+1, table:'albums'},
      dataType: "html",
      success: function(response){
        console.log('success');
      }
    });
  }
  Materialize.toast('Reihenfolge aktualisiert', 2500, '',function(){location.reload();});
});
</script>
<?php endif;?>
