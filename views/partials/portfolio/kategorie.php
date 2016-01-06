<div class="row">
    <?php echo Message::show(); ?>
    <?php if(!sizeof($data['albums'])) :?>
      <p>No Data</p>
    <?php else:?>
       <?php
       $i=1;
       foreach ($data['albums'] as $key => $value) :?>
        <div class="col s12 m4 l3">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light kategorie-image">
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
                <?php endif; ?>
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
                 url: <?php DIR ?>'/portfolio/shows',
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
        <?php endif;?>
      <?php;endforeach; ?>
    <?php endif;?>
</div>

<script type="text/javascript">
$(document).ready(function(){
  //trigger modal
  $('.modal-trigger-editKategorie').leanModal();
});
$('a#editForm').click(function(){
  console.log($(this).attr('album_id'));
  $('#formEdit').show();
});
$('#closeForm').click(function(){
  $('#formEdit').hide();
});
</script>
