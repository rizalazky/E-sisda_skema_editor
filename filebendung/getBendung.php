<?php
    include './../conn.php';
    $query=mysqli_query($conn,"select id,lokasi,a_tanam,q_diberikan FROM alokasi WHERE id in (SELECT MAX(alo.id) FROM alokasi alo GROUP BY alo.lokasi) AND di='$_GET[kode_bendung]' ORDER BY id DESC");
  
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
