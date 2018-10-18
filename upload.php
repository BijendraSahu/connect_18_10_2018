<?php
include ("../connection.php");
date_default_timezone_set("Asia/Kolkata");
$name = ''; $type = ''; $size = ''; $error = '';

function compress_image($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url); if ($info['mime'] == 'image/jpeg')

        $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
    elseif ($info['mime'] == 'video/mp4') $image = imagecreatefrompng($source_url);
    imagejpeg($image, $destination_url, $quality); return $destination_url;
}

function GetImageExtension($imagetype)
{
    if(empty($imagetype)) return false;
    switch($imagetype)
    {
        case 'image/bmp': return '.bmp';
        case 'image/gif': return '.gif';
        case 'image/jpeg': return '.jpg';
        case 'image/png': return '.png';
        case 'video/mp4': return '.mp4';
        default: return false;
    }

}

if(isset($_REQUEST['messageData']) && isset($_REQUEST['mess_heading'])  && isset($_REQUEST['mess_city']) )
{

    $mess_file="";
    if ($_FILES["file"]["error"] > 0)
    {
        $error = $_FILES["file"]["error"];
    } else if (($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")|| ($_FILES["file"]["type"] == "video/mp4"))
    {
        $url = 'destination .jpg';

        $file_name=$_FILES["file"]["name"];
        $temp_name=$_FILES["file"]["tmp_name"];
        $imgtype=$_FILES["file"]["type"];
        $ext= GetImageExtension($imgtype);
        $imagename=date("Y-m-d")."-".time().$ext;
        $url = "../../messageimg/".$imagename;

        if($ext=='.mp4')
        {
            move_uploaded_file($_FILES["file"]["tmp_name"],$url);

            $mess_file='video';
        }
        else
        {
            $filename = compress_image($_FILES["file"]["tmp_name"], $url, 30);
            $mess_file='image';
        }


    }
    else {
        $result=array('status' => 'error', 'msg' => 'Uploaded image should be jpg or gif or png or mp4');
        echo json_encode($result);
        die();
    }





    if($file_name=="")
    {
        $file  = "";
        $notifile="" ;
    }
    else
    {
        $file  = "messageimg/".$imagename;
        $notifile="http://www.myreporter.co.in/".$file ;
    }

    $messageData  = $_POST['messageData'] ;
    $mess_heading  = $_POST['mess_heading'] ;
    $mess_cat     = 3 ;
    $mess_city    = $_POST['mess_city'] ;
    $u_id=$_POST['u_id'];



    $mess_status  = "A" ;
    $mess_date=date('Y-m-d H:i:s');
    $sql = "INSERT INTO messages (mess_id, mess_text, mess_img,mess_sender,mess_date,mess_type,mess_status,mess_file,mess_cat,mess_city,mess_heading) VALUES ('', '$messageData','$file', '$u_id','$mess_date','image','$mess_status','$mess_file','$mess_cat','$mess_city','$mess_heading');";
    $qur = mysql_query($sql);

    $result=array('status' => 'success', 'msg' => 'Successfully Saved');

    echo json_encode($result);
}
else
{
    $result=array('status' => 'error', 'msg' => 'All data not sent');
    echo json_encode($result);
}
?>