<table>
  <?php foreach($data['images']as $key=>$value): ?>
    <tr>
        <img class="materialboxed responsive-img" data-caption="A picture of some deer and tons of trees" width="250" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
    </tr>
    <?php endforeach; ?>
</table>
