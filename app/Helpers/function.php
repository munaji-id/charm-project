<?php

function cek_modul($proyek_id, $modul_id){
  $data=App\ProjectModul::where('proyek_id',$proyek_id)->where('modul_id',$modul_id)->count();
  return $data;
}

?>