<?php
$targe_dir ="uploads/";
$targe_file=$targe_dir.time()."-".basename($_FILES["image"]["name"]);
$upload =1;
$imageFileType= strtolower(pathinfo($targe_file(PATHINFO_EXTENSION)));
$check=getimagesize($_FILES["image"]["tmp_name"]);
if($check!=false){
  $uploadOk=1;
}else{
  $uploadOk=0;
  $error.="Uploaded file is not a valid image";
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
  $uploadOk = 1;
}else{
  $uploadOk = 0;
  $error.="image type is not supported";
}
if($uploadOk==0){
  $response['status']=0;
  $response['message']=$error;
}else {
    if(move_uploaded_file($_FILES["image"]["tmp_name"],$targe_file)){
          $response['status']=1;
        $response['message']="image uploaded successfully";  
      }else{
       $response['status']=0;
        $response['message']="Unable to upload image ";
      }
}
echo json_encode($response);
?>