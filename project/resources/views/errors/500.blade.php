
@php
  $actual_path = str_replace('project','',base_path());
 if (is_dir($actual_path . '/install')) {
     echo '<meta http-equiv="refresh" content="0; url='.url('/install').'" />';

 }else{
     echo '<h2>500 Internal server error!</h2>';
 }
@endphp

