<?php
  $meter=$objr_meter['meter_united'];
  $unit=0;
  if($meter>='0' && $meter<='80'){
      $unit='3';
  }
  elseif ($meter>='81' && $meter<='100'){
      $unit='6';    
  }  
  elseif ($meter>='101' && $meter<='200'){
      $unit='9';
  }
  else ( $unit="12");