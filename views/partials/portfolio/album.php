<table>
  <?php foreach($data['images']as $key=>$value): ?>
    <tr>
        <td><?php echo $value['name']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
