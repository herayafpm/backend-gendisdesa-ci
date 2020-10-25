<?php

function upload_file($image_difabel)
{
  // upload file
  $image_difabelData = base64_decode($image_difabel);
  $f = finfo_open();
  $mime_type = finfo_buffer($f, $image_difabelData, FILEINFO_MIME_TYPE);
  finfo_close($f);
  $acceptType = ['image/jpeg','image/png','image/jpg'];
  if(in_array($mime_type,$acceptType)){
    [$image,$imageType] = explode('/',$mime_type);
    $fileName = uniqid('img_').time()."_".rand(1,100).".$imageType";
    $filePath = FCPATH.'uploads/'.$fileName;
    $image = file_put_contents($filePath, $image_difabelData);
    $ImageSize = filesize($filePath) / 1024;
    // Ukuruan maximum file 2MB
    $maximage_difabelSize = 2;
    if($ImageSize > $maximage_difabelSize * 1024){
      unlink($filePath);
      throw new Exception("Foto harus kurang dari ".$maximage_difabelSize."MB");
    }else{
      return $fileName;
    }
  }else{
    throw new Exception("tipe foto yang diperbolehkan adalah ".implode(", ",$acceptType));
  }
}