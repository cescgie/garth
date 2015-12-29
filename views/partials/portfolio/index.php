<?php echo Message::show(); ?>

  <div class="row">
    <?php foreach ($data['kategories'] as $key => $value) :?>
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light hoverable">
            <a href="<?= DIR ?>portfolio/kategorie/<?= $value['name'];?>">
              <img style="border-color:white" src="<?= DIR ?>assets/portfolio/<?= ucfirst($value['name']);?>.jpg">
            </a>
          </div>
          <div class="card-content">
            <p class="center activator grey-text text-darken-4 "><?= ucfirst($value['name']); ?></p>
          </div>
        </div>
      </div>
    <? endforeach;?>
  </div>
