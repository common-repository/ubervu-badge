=== uberVU Badge ===
Author: uberVU Team
Contributors: emanuel.lainas
Author URI: http://www.ubervu.com
Tags: comments, reactions, ubervu
Requires at least: 2.0.2
Tested up to: 2.9.1
Stable tag: 1.3

== Description ==
The badge shows a live count of the number of times your blog post has been shared or commented on a variety of social networks: Twitter, Friendfeed, Digg, Hacker News, Yahoo Buzz, Reddit, Stumble Upon, Delicious.

== Installation ==

1. Upload 'ubervu_badge.php' to the '/wp-content/plugins/' directory
2. Activate it from the 'Plugins' menu in your WordPress Admin panel
3. You can customize the plugin display options by selecting 'uberVU Badge' from the Settings menu, after the activation has been completed. Here you can choose a preferred style (regular or compact) and select the position of the badge (either on top of a blog post, bellow it or both).
4. There is also an option that allows you to manually specify the location. After choosing this option, it is required to place the following code in your Wordpress theme template (usually in 'single.php'): `<?php ubervu_badge(); ?>`
5. The ubervu_badge() function has three optional parameters: post_id, post_title and post_url. You can specify these parameters in order to insert the code in any Wordpress page, regardless of it's current content, or to further customize the badge.