<div class="row">
  <div class="col l12 s12">
    <?php if(!sizeof($data['albums'])) :?>
      <p>No Data</p>
    <?php else:?>
      <?php $i=1;foreach($data['albums']as $key=>$value): ?>
      <div class="col l4 m4 foto_album">
        <div class="card">
          <div class="card-image hoverable">
            <a href="/portfolio/album?album=<?= $value['name'];?>&kategorie=<?= $data['kategorie_name'];?>">
              <img src="/assets/img/background<?=$i++?>.jpg">
            </a>
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><?= ucwords($value['name']);?><i class="material-icons right">more_vert</i></span>
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><?= ucwords($value['name']);?><i class="material-icons right">close</i></span>
            <p>Here is some more information about this product that is only revealed once clicked on.</p>
          </div>
        </div> <!-- card -->
      </div>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>

<!--
<div class="row">
  <div class="input-field col s12 l4 m5">
        <select id="list">
          <option value="">Kategorie auswählen</option>
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
</script>-->
