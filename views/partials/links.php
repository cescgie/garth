<div class="row">
  <div class="body_text">
    <div class="col s12 m12 l12" id="preview_content">
      <?php if(isset($data['links'])){
        foreach ($data['links'] as $key => $value) {
          echo $value['content'];
        }
      }?>
    </div>
  </div>
</div>
<?php if(SESSION::get('admin')) :?>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
  tinymce.init({
    selector:'textarea',
    height: 250,
    plugins: 'link'
  });
  </script>

  <?php if(isset($data['links'])):?>
    <?php foreach ($data['links'] as $key => $value) :?>
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
      $('#preview_content').empty();
      $('#preview_content').html(content);
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
              url: "links/update",
              success: function(result){
                Materialize.toast('Impressum aktualisiert', 4000,'grey') // 4000 is the duration of the toast
              }
            });
      }
    });
  });
  </script>
<?php endif;?>
