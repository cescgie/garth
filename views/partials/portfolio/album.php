<div class="row">
  <div class="col l12 s12">
    <?php foreach($data['images']as $key=>$value): ?>
    <div class="col l4 m4 foto_album">
      <a href="<?php DIR ?>show?album=<?= $value['album'];?>&kategorie=<?= $value['kategorie'];?>&reihenfolge=<?= $value['reihenfolge'];?>">
        <img class="responsive-img z-depth-3" data-caption="A picture of some deer and tons of trees" width="100%" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
      </a>
    </div>
  <?php endforeach; ?>
  </div>
</div>
