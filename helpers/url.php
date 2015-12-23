<?php

class URL {

  /*
  * @param : url,status
  * @use : URL::REDIRECT(url,status)
  */
   public static function REDIRECT($url = null, $param = null, $status) {
      header('Location: ' . DIR . $url . $param, true, $status);
      exit;
   }

   /*
   * @param : filename,type
   * @use : URL::HALT()
   */
   public static function HALT($status = 404, $message = 'Something went wrong.') {
      if (ob_get_level() !== 0) {
          ob_clean();
      }

      http_response_code($status);
      $data['status'] = $status;
      $data['message'] = $message;

      if (!file_exists("views/error/$status.php")) {
         $status = 'default';
      }
      require "views/error/$status.php";

      exit;
   }

   /*
   * @param : filename,type
   * @use : URL::SCRIPTS(filename,type)
   */
   public static function EXTRAS($filename = false, $type = false, $path = 'libs/extra/') {
      if ($filename) {
         $path .= "$filename.$type";
      }
      return DIR . $path;
   }

   /*
   * @param : filename,type
   * @use : URL::MATERIALIZE(filename,type)
   */
   public static function MATERIALIZE($filename = false, $type = false, $path = 'libs/materialize/') {
      if ($filename) {
         $path .= "$type/$filename.$type";
      }
      return DIR . $path;
   }

   /*
   * @param : filename,folder
   * @use : URL::ASSETS(filename,folder)
   */
   public static function ASSETS($filename = false, $folder = false ,$path = 'assets/') {
      if ($filename) {
         $path .= "$folder/$filename";
      }
      return DIR . $path;
   }

}
