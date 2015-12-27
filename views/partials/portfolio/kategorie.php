<div class="row">
  <div class="col l12 s12">
    <?php if(!sizeof($data['albums'])) :?>
      <p>No Data</p>
    <?php else:?>
      <?php $i=1;foreach($data['albums']as $key=>$value): ?>
      <div class="col l4 m4 foto_album">
        <div class="card">
          <div class="card-image">
            <a href="/portfolio/album?album=<?= $value['name'];?>&kategorie=<?= $data['kategorie_name'];?>">
              <img src="/assets/img/background<?=$i++?>.jpg">
              <span class="card-title"><?= $value['name'];?></span>
            </a>
          </div>
          <div class="card-content">
            <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
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
