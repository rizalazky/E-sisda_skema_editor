<?php
    include './../conn.php';
    $query=mysqli_query($conn,"SELECT max(id) as id,lokasi,a_tanam FROM alokasi WHERE di='$_GET[kode_bendung]' GROUP BY lokasi ORDER BY id DESC");
  
    $data=array();
    if(!$query){
      echo mysqli_error($conn);
      die;
    }else{
        while($row=mysqli_fetch_array($query)){
            array_push($data,$row);
        }
    }
    
    echo json_encode($data);

?>