<?php if(SESSION::get('admin')) :?>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<?php endif;?>

<div class="row">
  <div class="body_text">
    <div class="col l6 m6">
      <div class="vita_h4 z-depth-2" style="position:relative">
        <center>
          <?php if(isset($data['vita3'])):?>
            <?php foreach ($data['vita3'] as $key => $value) :?>
              <img id="img_vita3" style="border-color:white;width:80%;margin:auto" class="responsive-img hoverable z-depth-3" src="<?=$value['content']?>" alt="vita img"/>
            <?php endforeach;?>
          <?php endif;?>
        </center>
        <?php if(SESSION::get('admin')) :?>
          <form id="imageUploadForm" action="vita/upload">
            <div class="file-field input-field">
              <div class="btn">
                <span>File</span>
                <input id="image" name="image" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
              <?php if(isset($data['vita3'])):?>
                <?php foreach ($data['vita3'] as $key => $value) :?>
                  <input type="hidden" name="id_content3" id="id_content3" value="<?=$value['id'];?>">
                <?php endforeach;?>
              <?php endif;?>
            </div>
          </form>
          <script type="text/javascript">
            $(document).ready(function (e) {
                $('#imageUploadForm').on('submit',(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var new_img_url = "assets/vita/"+formData.get('image').name;
                    $.ajax({
                        type:'POST',
                        url: $(this).attr('action'),
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            console.log(data);
                            $("#img_vita3").attr("src",new_img_url);
                            Materialize.toast('Bilder aktualisiert', 4000,'grey') // 4000 is the duration of the toast
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }));

                $("#image").on("change", function() {
                    $("#imageUploadForm").submit();
                });
              });
          </script>
        <?php endif;?>
      </div>
      <div id="preview_content1">
        <?php if(isset($data['vita1'])){
          foreach ($data['vita1'] as $key => $value) {
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

      <?php if(isset($data['vita1'])):?>
        <?php foreach ($data['vita1'] as $key => $value) :?>
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
          $('#preview_content1').empty();
          $('#preview_content1').html(content);
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
                  url: "vita/update",
                  success: function(result){
                    Materialize.toast('Vita 1.Spalte aktualisiert', 4000,'grey') // 4000 is the duration of the toast
                  }
                });
          }
        });
      });
      </script>
    <?php endif;?>
    </div>
    <div class="col l6 m6" >
      <div id="preview_content2">
        <?php if(isset($data['vita2'])){
          foreach ($data['vita2'] as $key => $value) {
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

        <?php if(isset($data['vita2'])):?>
          <?php foreach ($data['vita2'] as $key => $value) :?>
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
            $('#preview_content2').empty();
            $('#preview_content2').html(content);
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
                    url: "vita/update",
                    success: function(result){
                      Materialize.toast('Vita 2.Spalte aktualisiert', 4000,'grey') // 4000 is the duration of the toast
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
