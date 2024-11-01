<?php
/*
Plugin Name: uberVU Badge
Plugin URI: http://www.ubervu.com
Description: The badge shows a live count of the number of times your blog post has been shared or commented on a variety of social networks: Twitter, Friendfeed, Digg, Hacker News, Yahoo Buzz, Reddit, Stumble Upon, Delicious.
Author: uberVU Team
Version: 1.3
Author URI: http://www.ubervu.com
*/

function addUbervuBadge($postArray) {
  
  if (count($postArray) > 1) return $postArray;
  $post = $postArray[0];
  
  $style = get_option('ubervu_badge_style');
  if (!$style) {
    $style = 'regular';
    add_option('ubervu_badge_style', $style, null, 'no');
  }
  
  $url = get_permalink($post->ID);
  $title = $post->post_title;
  
  $badge = <<<SCR
    <script type="text/javascript">
    var ubervu_url = "$url";
    var ubervu_title = "$title";
    var ubervu_style = "$style";
    </script>
    <script type="text/javascript" src="http://badge.ubervu.com/badge.1.0.js"></script>
SCR;
  
  $pos = get_option('ubervu_badge_pos');
  
  if ($pos == 'top' || $pos == 'topbottom')
      $post->post_content = $badge.$post->post_content;
  if (!$pos || $pos == 'bottom' || $pos == 'topbottom')
      $post->post_content .= $badge;
	
	return $postArray;
}

function ubervuBadgeMenu() {
    add_options_page('uberVU Badge', 'uberVU Badge', 'administrator', 'uboptions', 'ub_options_page');
}

function ub_options_page() {
  global $services;
?>
<div class="wrap">
<h2>uberVU Reaction Count Badge</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row">Location</th>
<td valign="bottom">
  <input type="radio" name="ubervu_badge_pos" value="bottom" <?=(get_option("ubervu_badge_pos")=='bottom' || !get_option("ubervu_badge_pos"))?'checked="checked"':''?>>Bottom</option>
  <input type="radio" name="ubervu_badge_pos" value="top" <?=(get_option("ubervu_badge_pos")=='top')?'checked="checked"':''?>>Top</option>
  <input type="radio" name="ubervu_badge_pos" value="topbottom" <?=(get_option("ubervu_badge_pos")=='topbottom')?'checked="checked"':''?>>Top + Bottom</option>
  <input type="radio" name="ubervu_badge_pos" value="manual" <?=(get_option("ubervu_badge_pos")=='manual')?'checked="checked"':''?>>Manual</option>
</td>
</tr>
<tr valign="top">
<th scope="row">Badge Style</th>
<td>
  <input type="radio" name="ubervu_badge_style" value="regular" <?=(get_option("ubervu_badge_style")=='regular' || !get_option("ubervu_badge_style"))?'checked="checked"':''?>>Regular</option>
  <input type="radio" name="ubervu_badge_style" value="compact" <?=(get_option("ubervu_badge_style")=='compact')?'checked="checked"':''?>>Compact</option>
</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="ubervu_badge_pos,ubervu_badge_style" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?
}

if (get_option('ubervu_badge_pos') == 'manual') {
  
  function ubervu_badge($post_id = '', $title = '', $url = '') {
      global $post;
      
      $post_id = ($post_id == '')?$post->ID:$post_id;
  
      $style = get_option('ubervu_badge_style');
      if (!$style) {
        $style = 'regular';
        add_option('ubervu_badge_style', $style, null, 'no');
      }
      
      if ($url == '')
        $url = get_permalink($post_id);
      if ($title == '') {
        $post = get_post($post_id);
        $title = $post->post_title;
      }

      echo <<<SCR
        <script type="text/javascript">
        var ubervu_url = "$url";
        var ubervu_title = "$title";
        var ubervu_style = "$style";
        </script>
        <script type="text/javascript" src="http://badge.ubervu.com/badge.1.0.js"></script>
SCR;
  
  }
}
else {
  add_filter('the_posts', 'addUbervuBadge', 1);
}

add_action('admin_menu', 'ubervuBadgeMenu');

?>