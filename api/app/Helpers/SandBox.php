<?php

/**
 *
 */

 namespace App\Helpers;

 use App\Helpers\DBIP;
 use App\Helpers\Browser;
 use App\Helpers\RandomStringGenerator;
 use App\Models\Test;
 use App\Models\User;
 use App\Models\UserTest;
 use App\Models\Highlights;
 use App\Models\Visitors;
 use App\Models\Countries;
 use App\Models\PageTrackings;


class SandBox {

  public static function getUrlTheme1Or2($theme, $fb_id, $title, $name, $img_url)
  {
    $url = '/grabzit/'.$theme.'/'.$fb_id.'/'.$name.'/'.$title.'/'.$img_url ;
      /*$url = $this->router->pathFor('grabzit', [
          'theme'     => $theme,
          'fb_id'     => $fb_id,
          'title'     => urlencode($title),
          'name'      => urlencode($name),
          'img_url'   => urlencode($img_url)
      ]);
      */
      return $url;
  }

  public static function getUrlTheme3($theme, $user_id, $name, $user_posts, $user_friends, $user_photos)
  {
      if(!empty($user_posts)){
          $volume = [];
          foreach ($user_posts as $key => $row) {
              $volume[$row['id']]  = $row['freq'];
          }
          arsort($volume);
          $user_best_friends_reactions = array_slice($volume, 0, 10,true);
          $id = array_rand($user_best_friends_reactions, 1);
          $friend_names = explode(" ", $user_posts[$id]['name']);

          $prenoms = array_slice($friend_names, 0, count($friend_names)-1,true);
          $friend_name = '';
          foreach ($prenoms as $val) {
              $friend_name .= $val.' ';
          }
          $totalPosts = count($user_best_friends_reactions);
          if($totalPosts === 0)
              $url = self::getUrlTheme1Or2('1', $user_id, 'No friend Reactions found', $name, 'resultat_1_1506534573_73.jpeg' );
          else
              $url = self::getUrlTheme1Or2($theme, $user_id, $friend_name, $name, $id );
      }
      elseif(!empty($user_friends)) {
          shuffle($user_friends);
          $totalFriends = sizeof($user_friends);
          if($totalFriends === 0)
              $url = self::getUrlTheme1Or2('1', $user_id, 'No friend found', $name, 'resultat_1_1506534573_73.jpeg' );
          else
              $url = self::getUrlTheme1Or2($theme, $user_id, $user_friends[0]['first_name'], $name, $user_friends[0]['id']);
      }
      else {
          $volume = [];
          foreach ($user_photos as $key => $row) {
              $volume[$row['id']]  = $row['freq'];
          }
          arsort($volume);
          $user_best_friends_reactions = array_slice($volume, 0, 10,true);
          $id = array_rand($user_best_friends_reactions, 1);
          $friend_names = explode(" ", $user_photos[$id]['name']);
          $prenoms = array_slice($friend_names, 0, count($friend_names)-1,true);
          $friend_name = '';
          foreach ($prenoms as $val) {
              $friend_name .= $val.' ';
          }
          $total = count($user_best_friends_reactions);
          if($total === 0)
              $url = self::getUrlTheme1Or2('1', $user_id, 'No Photos found', $name, 'resultat_1_1506534573_73.jpeg' );
          else
              $url = self::getUrlTheme1Or2($theme, $user_id, $friend_name, $name, $id );
      }
      return $url;

  }

  public static function getUrlTestPerso($test_id, $params, $lang = "fr")
  {
    $url = "/creation-test/ressources/views/themes/perso/".$lang."_file_test_".$test_id.".php" . $params;
    return $url;
  }
  // Unused

  public static function getFileTest($test_id)
  {
    return  "fr_file_test_".$test_id;
  }

  public static function getTempFile($user_id, $php, $css, $js)
  {
    // Create a temporary file for execute php code
    $url_temp_file_php = time().$user_id;
    $temp_file_php = fopen("ressources/views/tempfiles/".$url_temp_file_php.".php", "w+");
    if($temp_file_php==false)
    die("La création du fichier a échoué");
    // changement de tags pour le code php
    $code_php = str_replace('{%', '$_GET[\'', $php );
    $code_php = str_replace('%}', '\']', $code_php );

    // changement de tags pour les variables
    $code_php = str_replace('{?', '\'.$_GET[\'', $code_php );
    $code_php = str_replace('?}', '\'].\'', $code_php );

    // changement de tags pour le code html
    $code_php = str_replace('{{', '<?php echo $_GET[\'', $code_php );
    $code_php = str_replace('}}', '\']; ?>', $code_php );
    fputs($temp_file_php, "<style>".$css."</style> \n" . "<script>".$js."</script> \n" . $code_php);
    return $url_temp_file_php;
  }


  public static function getPhotosProfile($uid , $fb_token )
  {
    $url_to_get_albums = 'https://graph.facebook.com/'.$uid.'/albums?access_token='.$fb_token.'&limit=10' ;
    $resp = self::getCURL($url_to_get_albums);
    $albums = json_decode($resp);

    foreach ($albums->data as $album) {
      if($album->name == 'Profile Pictures'){
        $id_profile_pictures_album = $album->id;
        $url_to_get_photos = 'https://graph.facebook.com/'.$id_profile_pictures_album.'/photos?access_token='.$fb_token;
        $resp = self::getCURL($url_to_get_photos);
        $photos = json_decode($resp);

        $data_photos = array();
        foreach ($photos->data as $photo) {
          $url_to_get_info_photo = 'https://graph.facebook.com/'.$photo->id.'?access_token='.$fb_token.'&fields=images,picture';
          $resp = self::getCURL($url_to_get_info_photo);
          $data_photo = json_decode($resp);

          $data_photos[$photo->id] = [
            'id'      => $photo->id,
            'url' => $data_photo->images[0]->source
          ];
        }
        break;
      }
    }

    return $data_photos;
  }

  public static function getCURL($url)
  {
    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    return $resp;
  }

}
