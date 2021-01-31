<?php

function cekNIK($nik)
{
  if($nik != "0"){
    $identitasDifabelModel =  new \App\Models\IdentitasDifabelModel();
    $difabel = $identitasDifabelModel->where('difabel_nik',$nik)->get()->getRow();
    if($difabel){
      throw new Exception("NIK Difabel sudah digunakan");
    }
  }
}