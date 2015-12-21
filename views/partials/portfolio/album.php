<table>
  <?php foreach($data['album']as $key=>$value): ?>
    <tr>
        <td><?php echo $value['name']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
