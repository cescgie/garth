<?php echo Message::show(); ?>

  <div class="row">
    <?php foreach ($data['kategories'] as $key => $value) :?>
      <div class="col s12 m4 l3">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light index-image">
            <a href="<?= DIR ?>portfolio/kategorie/<?= $value['name'];?>">
              <center><img style="border-color:white;width:95%;position:absolute;margin:auto" class="responsive-img hoverable z-depth-3" src="<?= DIR ?>assets/portfolio/<?= ucfirst($value['name']);?>.jpg"></center>
            </a>
          </div>
          <div class="card-content">
            <p class="center activator grey-text text-darken-4 "><?= ucfirst($value['name']); ?></p>
          </div>
        </div>
      </div>
    <? endforeach;?>
  </div>
