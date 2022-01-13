<?php

function upload_image($directory, $file, $prefix_filename)
{
      $extenstion = $file->getClientOriginalExtension();
      $filename = "$prefix_filename-" . date('YmdHi') . "." . $extenstion;
      $path = public_path($directory);

      $file->move($path, $filename);

      return $filename;
}
