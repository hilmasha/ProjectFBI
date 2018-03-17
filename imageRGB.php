<!DOCTYPE html>
<html>
<body>

<?php
$im = imagecreatefromjpeg("Face.jpg");
$rgb = imagecolorat($im, 10, 15);
$r = ($rgb >> 16) & 0xFF;
$g = ($rgb >> 8) & 0xFF;
$b = $rgb & 0xFF;
 echo var_dump($r, $g, $b) ;
  echo "Successfully added";
?>

</body>
</html>
