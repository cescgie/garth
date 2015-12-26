<div class="row">
  <div class="col l12 s12">
    <?php foreach($data['images']as $key=>$value): ?>
    <div class="col l4 m4 foto_album">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
          <a href="<?php DIR ?>show?album_id=<?= $value['album_id'];?>&kategorie_id=<?= $value['kategorie_id'];?>&reihenfolge=<?= $value['reihenfolge'];?>">
            <img class="responsive-img z-depth-3 activator" data-caption="A picture of some deer and tons of trees" width="100%" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
          </a>
        </div>
        <div class="card-content">
          <p class="card-title activator grey-text text-darken-4 center"><?= preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['name']);?></p>
          <?php if(SESSION::get('admin')) :?>
            <button class="waves-effect waves-light btn btn-navigator" style="background-color:#1e88e5">Edit</button>
            <button class="waves-effect waves-light btn btn-navigator" style="background-color:#ff5252;">Delete</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>
