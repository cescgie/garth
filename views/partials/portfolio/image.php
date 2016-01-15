<div id="image_show">
  <table>
    <tr>
      <td class="left">
        <a id="prev_action" href="<?php DIR ?>show?album_id=<?= $data['album_id'];?>&kategorie_id=<?= $data['kategorie_id'];?>&reihenfolge=<?= $data['prev_photo_id'];?>#image_show" class="waves-effect waves-light btn btn-navigator"><i class="material-icons left">skip_previous</i>zurrück</a>
      </td>
      <td class="right">
        <a id="next_action" href="<?php DIR ?>show?album_id=<?= $data['album_id'];?>&kategorie_id=<?= $data['kategorie_id'];?>&reihenfolge=<?= $data['next_photo_id'];?>#image_show" class="waves-effect waves-light btn btn-navigator"><i class="material-icons right">skip_next</i>nächste</a>
      </td>
    </tr>
  </table>
  <?php foreach($data['show_foto']as $key=>$value): ?>
    <center><img id="image_show_id" class="materialboxed responsive-img z-depth-3" data-caption="<?php echo $value['title'];?>" src="<?= DIR.$value['path']; ?>"></center><br>
    <div class="center">
      <h4><?= $value['title'];?></h4>
      <p><?= $value['description'];?></p>
    </div>
  <?php endforeach; ?>
</div>

<script type="text/javascript">
  $(document).keydown(function(e){
    if (e.keyCode == 37) {
       var href = $('#prev_action').attr('href');
       window.location.href = href;
       return false;
    }
    if (e.keyCode == 39) {
       var href = $('#next_action').attr('href');
       window.location.href = href;
       return false;
    }
  });
</script>
