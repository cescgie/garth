<div class="row">
  <div class="input-field col s12 l4 m5">
        <select id="list">
          <option value="">Choose album</option>
          <?php foreach($data['albums']as $key=>$value): ?>
            <option value="<?= $value['name'];?>"><?= ucfirst($value['name']);?></option>
          <?php endforeach; ?>
        </select>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
  $('#list').change(function() {
    var album_name = $(this).val();
    var kategorie_name = "<?php echo $data['kategorie_name']?>";
    location.href = "/portfolio/album?album="+album_name+"&kategorie="+kategorie_name;
  });
</script>
