<table>
  <tr>
    <td class="left">
      <a href="<?php DIR ?>show?album=<?= $data['album'];?>&kategorie=<?= $data['kategorie'];?>&reihenfolge=<?= $data['prev_photo_id'];?>" class="waves-effect waves-light btn btn-navigator"><i class="material-icons left">skip_previous</i>zurrück</a>
    </td>
    <td class="right">
      <a href="<?php DIR ?>show?album=<?= $data['album'];?>&kategorie=<?= $data['kategorie'];?>&reihenfolge=<?= $data['next_photo_id'];?>" class="waves-effect waves-light btn btn-navigator"><i class="material-icons right">skip_next</i>nächste</a>
    </td>
  </tr>
</table>

<?php foreach($data['show_foto']as $key=>$value): ?>
  <img class="materialboxed responsive-img z-depth-3" data-caption="A picture of some deer and tons of trees" width="100%" src="<?= DIR."assets/collections/".date('d-m-Y', strtotime($value['created_at']))."/".$value['name']; ?>">
<?php endforeach; ?>
