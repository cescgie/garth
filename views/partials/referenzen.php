<?php if(SESSION::get('admin')) :?>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<?php endif;?>

<div class="row">
  <div class="body_text">
    <div class="col m6 l6" >
      <div id="referenzen1">
        <?php if(isset($data['referenzen1'])){
          foreach ($data['referenzen1'] as $key => $value) {
            echo $value['content'];
          }
        }?>
      </div>

      <?php if(SESSION::get('admin')) :?>
      <script>
      tinymce.init({
        selector:'#textarea_content1',
        height: 250,
        plugins: 'link'
      });
      </script>

      <?php if(isset($data['referenzen1'])):?>
        <?php foreach ($data['referenzen1'] as $key => $value) :?>
          <textarea id="textarea_content1"><?=$value['content'];?></textarea>
          <input type="hidden" name="id_content1" id="id_content1" value="<?=$value['id'];?>">
        <?php endforeach;?>
      <?php endif;?>
      <div class="row">
        <div class="col s12">
          <div class="left">
            <a class="waves-effect waves-light btn grey" id="preview1" ><i class="material-icons left">pageview</i>Vorschau</a>
          </div>
          <div class="right">
            <a class="waves-effect waves-light btn grey"  id="submit1" ><i class="material-icons right">save</i>Speichern</a>
          </div>
        </div>
      </div>

      <script type="text/javascript">
      $(document).ready(function() {
        $('#preview1').on('click',function(){
          var content = tinymce.get('textarea_content1').getContent();
          $('#referenzen1').empty();
          $('#referenzen1').html(content);
        });

        $('#submit1').on('click',function(){
          var content = tinymce.get('textarea_content1').getContent();
          var ids = $("#id_content1").val();
          if (content=="") {
            Materialize.toast('Empty content!', 4000,'grey') // 4000 is the duration of the toast
          }else{
            $.ajax({
                  type: "post",
                  data: {
                    "content":content,
                    "id":ids
                  },
                  url: "referenzen/update",
                  success: function(result){
                    Materialize.toast('Referenzen 1.Spalte aktualisiert', 4000,'grey') // 4000 is the duration of the toast
                  }
                });
          }
        });
      });
      </script>
    <?php endif;?>
    </div>
    <div class="col m6 l6" >
      <div id="referenzen2">
        <?php if(isset($data['referenzen2'])){
          foreach ($data['referenzen2'] as $key => $value) {
            echo $value['content'];
          }
        }?>
      </div>
      <?php if(SESSION::get('admin')) :?>
      <script>
      tinymce.init({
        selector:'#textarea_content2',
        height: 250,
        plugins: 'link'
      });
      </script>

      <?php if(isset($data['referenzen2'])):?>
        <?php foreach ($data['referenzen2'] as $key => $value) :?>
          <textarea id="textarea_content2"><?=$value['content'];?></textarea>
          <input type="hidden" name="id_content2" id="id_content2" value="<?=$value['id'];?>">
        <?php endforeach;?>
      <?php endif;?>
      <div class="row">
        <div class="col s12">
          <div class="left">
            <a class="waves-effect waves-light btn grey" id="preview2" ><i class="material-icons left">pageview</i>Vorschau</a>
          </div>
          <div class="right">
            <a class="waves-effect waves-light btn grey"  id="submit2" ><i class="material-icons right">save</i>Speichern</a>
          </div>
        </div>
      </div>

      <script type="text/javascript">
      $(document).ready(function() {
        $('#preview2').on('click',function(){
          var content = tinymce.get('textarea_content2').getContent();
          $('#referenzen2').empty();
          $('#referenzen2').html(content);
        });

        $('#submit2').on('click',function(){
          var content = tinymce.get('textarea_content2').getContent();
          var ids = $("#id_content2").val();
          if (content=="") {
            Materialize.toast('Empty content!', 4000,'grey') // 4000 is the duration of the toast
          }else{
            $.ajax({
                  type: "post",
                  data: {
                    "content":content,
                    "id":ids
                  },
                  url: "referenzen/update",
                  success: function(result){
                    Materialize.toast('Referenzen 2.Spalte aktualisiert', 4000,'grey') // 4000 is the duration of the toast
                  }
                });
          }
        });
      });
      </script>
    <?php endif;?>
    </div>
  </div>
</div>
