<h2>Welcome To RentSquare</h2>
<?php if(isset($inactive_properties) && count($inactive_properties) > 0):
   echo 'Properties pending activation:<br>';
   foreach($inactive_properties as $property):
     echo $property['Property']['name'] .': ';
     if($property['Property']['active'])
      echo 'Active';
     else
      echo 'Pending';
     echo '<br>';
   endforeach;
endif; ?>


<script>
function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
    });
}
preload([
    '/img/glyphicons-halflings-green.png',
]);
</script>