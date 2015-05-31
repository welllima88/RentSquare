Rent Square <?php echo date('l jS \of F Y h:i:s A'); ?>

<table style="border:1px solid black;">
<tr><th>Error</th><th>Message</th></tr>
<?php foreach($errors as $key => $val):
echo '<tr><td style="border:1px solid black;">' . $key . '</td><td style="border:1px solid black;">' . $val .'</td></tr>';
endforeach; ?>
</table>