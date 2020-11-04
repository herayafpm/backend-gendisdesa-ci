<?php
//var_dump(file_exists(realpath("/laragon/www/gendis-desa/public")));
//symlink("C:\laragon\www\uploads","C:\laragon\www\gendis-desa\public\uploads");
var_dump(exec('mklink /j '."C:\laragon\www\gendis-desa\public\uploads".' '."C:\laragon\www\uploads"));