<div class="row">
  <div class="col l12 s12">
    <?php foreach($data['images']as $key=>$value): ?>
    <div class="col l4 m4 foto_album">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="responsive-img z-depth-3 activator" data-caption="A picture of some deer and tons of trees" width="100%" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><?= preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['name']);?><i class="material-icons right">more_vert</i></span>
          <p>
            <a href="<?php DIR ?>show?album=<?= $value['album'];?>&kategorie=<?= $value['kategorie'];?>&reihenfolge=<?= $value['reihenfolge'];?>">Mehr anzeigen</a>
          </p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"><?= preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['name']);?><i class="material-icons right">close</i></span>
          <p>Here is some more information about this product that is only revealed once clicked on.</p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>
