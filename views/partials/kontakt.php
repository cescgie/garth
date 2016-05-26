<div class="row">
  <div class="col s12 l12 m12">
    <div class="body_text">
      <div id="preview_content">
        <div id="preview_contents">
          <?php if(isset($data['kontakt'])){
            foreach ($data['kontakt'] as $key => $value) {
              echo $value['content'];
            }
          }?>
        </div>
      </div>

      <?php if(SESSION::get('admin')) :?>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
        tinymce.init({
          selector:'#textarea_content',
          height: 250,
          plugins: 'link'
        });
        </script>

        <?php if(isset($data['kontakt'])):?>
          <?php foreach ($data['kontakt'] as $key => $value) :?>
            <textarea id="textarea_content"><?=$value['content'];?></textarea>
            <input type="hidden" name="id_content" id="id_content" value="<?=$value['id'];?>">
          <?php endforeach;?>
        <?php endif;?>
        <div class="row">
          <div class="col s12">
            <div class="left">
              <a class="waves-effect waves-light btn grey" id="preview" ><i class="material-icons left">pageview</i>Preview</a>
            </div>
            <div class="right">
              <a class="waves-effect waves-light btn grey"  id="submit" ><i class="material-icons right">send</i>Submit</a>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() {
          $('#preview').on('click',function(){
            var content = tinymce.get('textarea_content').getContent();
            $('#preview_contents').empty();
            $('#preview_contents').html(content);
          });

          $('#submit').on('click',function(){
            var content = tinymce.get('textarea_content').getContent();
            var ids = $("#id_content").val();
            if (content=="") {
              Materialize.toast('Empty content!', 4000,'grey') // 4000 is the duration of the toast
            }else{
              $.ajax({
                    type: "post",
                    data: {
                      "content":content,
                      "id":ids
                    },
                    url: "kontakt/update",
                    success: function(result){
                      Materialize.toast('Impressum aktualisiert', 4000,'grey') // 4000 is the duration of the toast
                    }
                  });
            }
          });
        });
        </script>
      <?php endif;?>
    </div>


    <div class="widget-upload" style="margin-top:30px;">
      <?php echo Message::show(); ?>
      <form action="<?= DIR?>kontakt/send" method="post">
        <div class="row">
          <div class="col l12 m12 s12">
              <h4 class="strong center" style="color:#000">Kontaktformular</h4>
              <div class="input-field col s12">
                <i class="material-icons prefix icon-color">account_circle</i>
                <input id="name" type="text" name="name" class="validate">
                <label for="name">Name</label>
              </div>
              <div class="input-field col s12">
                <i class="material-icons prefix icon-color">email</i>
                  <input id="email" type="email" name="email" class="validate">
                  <label for="email">Email</label>
              </div>
              <div class="input-field col s12">
                <i class="material-icons prefix icon-color">mode_edit</i>
                <textarea id="textarea_kontakt" name="textarea_kontakt" class="materialize-textarea" length="500"></textarea>
                <label for="textarea_kontakt">Kommentar</label>
              </div>
              <div class="right">
                <input class="btn waves-effect waves-light submit_kontakt" type="submit" value="Absenden" id="submit_kontakt">
              </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
