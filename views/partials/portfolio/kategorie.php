<table>
  <?php foreach($data['albums']as $key=>$value): ?>
    <tr>
        <td><a href="<?= DIR ?>portfolio/album/<?= $value['name'];?>"><?php echo $value['name']; ?></a></td>
    </tr>
    <?php endforeach; ?>
</table>
