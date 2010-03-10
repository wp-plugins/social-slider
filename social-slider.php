<?php
/*
Plugin Name: Social Slider
Plugin URI: http://xn--wicek-k0a.pl/projekty/social-slider
Description: This plugin adds links to your social networking sites' profiles in a box floating at the left side of the screen.
Version: 2.0.0
Author: Łukasz Więcek
Author URI: http://xn--wicek-k0a.pl/
*/

/*
=========================================================
License

Any interference or modification of the Social Slider's
and Social Slider Pro's source code, without the author's
written consent, is strictly forbidden.


Licencja

Zabrania się jakichkolwiek ingerencji w kodzie wtyczki,
oraz usuwania informacji o jej autorze, bez uzyskania
jego wczesniejszej zgody.
=========================================================
*/

function SocialSliderUstawienia()  {  global $wpdb, $table_prefix;   $RABA76B6ADE269F0F9B8406755A5266EF = $table_prefix."socialslider";      if($wpdb->get_var("SHOW TABLES LIKE '".$RABA76B6ADE269F0F9B8406755A5266EF."'") != $RABA76B6ADE269F0F9B8406755A5266EF)   {      $wpdb->query("CREATE TABLE  `".$RABA76B6ADE269F0F9B8406755A5266EF."` (`id` TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,`lp` TINYINT NOT NULL,`ikona` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`nazwa` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`adres` VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL) ENGINE = MYISAM ;");   $wpdb->query("ALTER TABLE  `".$RABA76B6ADE269F0F9B8406755A5266EF."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");       $R0F49BC23F51324E67A79438766032DF3 = 1;    $wpdb->query("INSERT INTO  `".$RABA76B6ADE269F0F9B8406755A5266EF."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'rss',    'Kanał RSS',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'newsletter',   'Newsletter',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'sledzik',   'Śledzik',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'blip',    'Blip',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'flaker',   'Flaker',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'twitter',   'Twitter',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'soup',    'Soup.io',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'buzz',    'Buzz',''),       (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'facebook',   'Facebook',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'spinacz',   'Spinacz',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'goldenline',   'GoldenLine',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'naszaklasa',   'Nasza Klasa',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'networkedblogs',  'NetworkedBlogs',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'myspace',   'MySpace',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'digg',    'Digg',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'wykop',    'Wykop',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'kciuk',    'Kciuk',''),        (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'picasa',   'Picasa',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'flickr',   'Flickr',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'panoramio',   'Panoramio',''),        (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'youtube',   'YouTube',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'vimeo',    'Vimeo',''),        (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'lastfm',   'Last.fm',''),    (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'ising',    'iSing',''),        (NULL,  '".$R0F49BC23F51324E67A79438766032DF3++."',   'delicious',   'Delicious','')    ;");         delete_option('socialslider_rss');   delete_option('socialslider_newsletter');   delete_option('socialslider_sledzik');   delete_option('socialslider_blip');   delete_option('socialslider_flaker');   delete_option('socialslider_twitter');   delete_option('socialslider_soup');   delete_option('socialslider_buzz');      delete_option('socialslider_facebook');   delete_option('socialslider_spinacz');   delete_option('socialslider_goldenline');   delete_option('socialslider_naszaklasa');   delete_option('socialslider_networkedblogs');   delete_option('socialslider_myspace');   delete_option('socialslider_digg');   delete_option('socialslider_wykop');   delete_option('socialslider_kciuk');      delete_option('socialslider_picasa');   delete_option('socialslider_flickr');   delete_option('socialslider_panoramio');      delete_option('socialslider_youtube');   delete_option('socialslider_vimeo');      delete_option('socialslider_lastfm');   delete_option('socialslider_ising');      delete_option('socialslider_delicious');   }   include("language.php");   if(WPLANG=="pl_PL") {$RAEBC944BFE29E997E2AFFDD9DC9E71D7 = "pl_PL";}  else     {$RAEBC944BFE29E997E2AFFDD9DC9E71D7 = "en_US";}   if($_POST['SocialSliderZapisz'])   {      $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$RABA76B6ADE269F0F9B8406755A5266EF."");    foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)    {    $R6C6F2FFA347EF13815DB0C336428E5A1 = "socialslider_".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona;        $wpdb->query("UPDATE `".$RABA76B6ADE269F0F9B8406755A5266EF."` SET `adres` = '".$_POST[$R6C6F2FFA347EF13815DB0C336428E5A1]."' WHERE `ikona` = '".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."'");    }         if(!empty($_POST['socialslider_widget']))    {    if(get_option('socialslider_widget'))  {update_option('socialslider_widget', $_POST['socialslider_widget']);}    else          {add_option('socialslider_widget', $_POST['socialslider_widget']);}    }   else    {    if(get_option('socialslider_widget'))  {delete_option('socialslider_widget');}    }       if(!empty($_POST['socialslider_widget_width']))    {    if(get_option('socialslider_widget_width')) {update_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}    else          {add_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}    }   else    {    if(get_option('socialslider_widget_width')) {update_option('socialslider_widget_width', '200');}    else          {add_option('socialslider_widget_width', '200', ' ', 'yes');}    }         if(!empty($_POST['socialslider_link']))    {    if(get_option('socialslider_link'))   {update_option('socialslider_link', $_POST['socialslider_link']);}    else          {add_option('socialslider_link', $_POST['socialslider_link'], ' ', 'yes');}    }   else    {    if(get_option('socialslider_link'))   {update_option('socialslider_link', 'tak');}    else          {add_option('socialslider_link', 'tak', ' ', 'yes');}    }       if(!empty($_POST['socialslider_top']))    {    if(get_option('socialslider_top'))   {update_option('socialslider_top', $_POST['socialslider_top']);}    else          {add_option('socialslider_top', $_POST['socialslider_top'], ' ', 'yes');}    }   else    {    if(get_option('socialslider_top'))   {update_option('socialslider_top', '150');}    else          {add_option('socialslider_top', '150', ' ', 'yes');}    }         if(!empty($_POST['socialslider_tryb']))    {    if(get_option('socialslider_tryb'))   {update_option('socialslider_tryb', $_POST['socialslider_tryb']);}    else          {add_option('socialslider_tryb', $_POST['socialslider_tryb'], ' ', 'yes');}    }   else    {    if(get_option('socialslider_tryb'))   {delete_option('socialslider_tryb');}    }   }   if($_POST['SocialSliderPasshPro'])   {   if(!empty($_POST['socialslider_passhb']))    {    $R83A253518CA7E08752DBE5B5D61FAA78 = curl_init();    $R6E4F14B335243BE656C65E3ED9E1B115 = "http://social-slider.xn--wicek-k0a.pl/passh.php?passhb=".$_POST['socialslider_passhb']."&url=".str_replace("http://", "", get_bloginfo('url'));     curl_setopt($R83A253518CA7E08752DBE5B5D61FAA78, CURLOPT_HEADER, 0);    curl_setopt($R83A253518CA7E08752DBE5B5D61FAA78, CURLOPT_RETURNTRANSFER, 1);    curl_setopt($R83A253518CA7E08752DBE5B5D61FAA78, CURLOPT_URL, $R6E4F14B335243BE656C65E3ED9E1B115);     $R7318A606A3118D468DAE7078098FBA7B = curl_exec($R83A253518CA7E08752DBE5B5D61FAA78);    curl_close($R83A253518CA7E08752DBE5B5D61FAA78);     if(!empty($R7318A606A3118D468DAE7078098FBA7B))     {     if(get_option('socialslider_licencja'))  {update_option('socialslider_licencja', $R7318A606A3118D468DAE7078098FBA7B);}     else          {add_option('socialslider_licencja', $R7318A606A3118D468DAE7078098FBA7B, ' ', 'yes');}     }    else     {     if(get_option('socialslider_licencja'))  {delete_option('socialslider_licencja');}     }    }   }  $R7D1CC646E4E2E6F49016FAC2A089ACC5 = base64_decode(get_option('socialslider_licencja'));  ?>
	<div class="wrap">
		<style type="text/css">
			input, textarea, select
				{
				color: #555;
				}

			ul.serwisy
				{
				width: 660px;
				margin-left: 20px;
				}
			
			ul.serwisy li
				{
				margin-bottom: 10px;
				}

			ul.serwisy label
				{
				width: 150px;
				float: left;
				}

			div.pro label
				{
				width: 140px;
				float: left;
				}

			ul.serwisy label img
				{
				margin-right: 5px;
				vertical-align: middle;
				width: 20px;
				height: 20px;
				}

			ul.serwisy input, ul.serwisy textarea, div.pro input.text, div.pro select
				{
				float: right;
				}

			ul.serwisy input.text, ul.serwisy textarea
				{
				width: 500px;
				}
			
			div.opcja
				{
				margin: 0 0 40px 20px;
				}

			p.radio
				{
				color: #555;
				font-size: 11px;
				margin-left: 20px;
				}
			
			div.pro
				{
				width: 800px;
				}
			
			div.pro input.text, div.pro select
				{
				margin-right: 340px;
				}

			div.pro ul
				{
				list-style-type: circle;
				margin: 0 0 40px 20px;
				}
		
		</style>

		<?php   if(date("Y-m-d")<=base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)) {$R00649A69C5F0DF91C60003FF666E4E22 = "Social Slider Pro"; $R7EE3BF8C9163234E4665CA2856AC61CE = "lp";}   else             {$R00649A69C5F0DF91C60003FF666E4E22 = "Social Slider";  $R7EE3BF8C9163234E4665CA2856AC61CE = "id";}   ?>

		<div id="socialslider">
			<h2><?php echo $lang[1][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> <?php echo $R00649A69C5F0DF91C60003FF666E4E22; ?></h2>

			<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-config"> 

				<div class="opcja">
					<p><?php echo $lang[2][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="pelny"<?php if(get_option('socialslider_tryb')=="pelny" OR !get_option('socialslider_tryb')) echo " checked"; ?> /> <?php echo $lang[3][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="uproszczony"<?php if(get_option('socialslider_tryb')=="uproszczony") echo " checked"; ?> /> <?php echo $lang[4][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="kompaktowy"<?php if(get_option('socialslider_tryb')=="kompaktowy") echo " checked"; ?> /> <?php echo $lang[5][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="minimalny"<?php if(get_option('socialslider_tryb')=="minimalny") echo " checked"; ?> /> <?php echo $lang[6][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[8][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_top')) {echo get_option('socialslider_top');} else {echo "150";} ?>" name="socialslider_top" id="socialslider_top" />px (<?php echo $lang[13][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>: 150px)</p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[14][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)) {echo " (".$lang[15][$RAEBC944BFE29E997E2AFFDD9DC9E71D7].")";}?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_widget_width')) {echo get_option('socialslider_widget_width');} else {echo "200";} ?>" name="socialslider_widget_width" id="socialslider_widget_width" <?php if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)) {echo "readonly";} ?>/>px (<?php echo $lang[13][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>: 200px)</p>
				</div>
				
				<div class="opcja">
					<p><?php echo $lang[36][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</p>
					<p class="radio"><input type="radio" class="text" value="tak" name="socialslider_link" id="socialslider_link"<?php if(get_option('socialslider_link')=="tak") echo " checked"; ?> checked /> <?php echo $lang[37][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
					<p class="radio"><input type="radio" class="text" value="nie" name="socialslider_link" id="socialslider_link"<?php if(get_option('socialslider_link')=="nie") echo " checked"; if(date("Y-m-d")>base64_decode(get_option('socialslider_licencja'))) {echo "disabled";} ?>/> <?php echo $lang[38][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> <?php if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)) {echo " (".$lang[15][$RAEBC944BFE29E997E2AFFDD9DC9E71D7].")";}?></p>
				</div>

				<div class="opcja">
				<?php     if(date("Y-m-d")<=base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5))      {      ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){ 
							jQuery(function() {
								jQuery("ul#serwisy").sortable({ opacity: 0.6, cursor: 'hand', update: function() {
									var order = jQuery(this).sortable("serialize") + '&action=ZapiszPozycje'; 
									jQuery.post("/wp-content/plugins/social-slider/ajax.php", order, function(theResponse){
										jQuery("div#ajax").html(theResponse);
									}); 															 
								}								  
								});
							});
						});	
					</script>
					<?php } ?>

					<p><?php echo $lang[9][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
					<ul id="serwisy" class="serwisy">
						<?php       $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$R7EE3BF8C9163234E4665CA2856AC61CE." ASC");       foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)        {        echo "<li id='rA_".$R53B955D8243FC7B0A585BC28FFBCB5EB->id."'>         <label for 'socialslider_".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."'><img src='/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-20.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' />".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa.":</label>         <input type='text' class='text' value='".$R53B955D8243FC7B0A585BC28FFBCB5EB->adres."' name='socialslider_".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."' id='socialslider_".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."' /><br style='clear: both;' />        </li>";        }       ?>
					</ul>
					<ul class="serwisy">
						<li>
							<label for 'socialslider_widget'><img src='/wp-content/plugins/social-slider/images/widget-20.png' alt='Widget' /> <?php echo $lang[10][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
							<textarea name="socialslider_widget" id="socialslider_widget" style="height: 200px;"><?php echo stripslashes(get_option('socialslider_widget')); ?></textarea>
						</li>
						<br style='clear: both;' />
					</ul>
					
					<input type="submit" name="SocialSliderZapisz" value="<?php echo $lang[12][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>" style="margin: 10px 0 15px 178px;" />
					
					
				</div><p><?php echo $lang[35][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>

			</form>
			
			<h2 id="pro"><?php echo $lang[16][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></h2>
			<div class="pro">
			
			<?php    if(date("Y-m-d")<=base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5))     {     if(base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)!="2099-12-31") {$RBA66D15CDF62D2FB4401BB274E32DCC3 = base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5);}     else             {$RBA66D15CDF62D2FB4401BB274E32DCC3 = $lang[39][$RAEBC944BFE29E997E2AFFDD9DC9E71D7];}      echo "<p style='margin-left: 20px; font-style: italic;'>".$lang[40][$RAEBC944BFE29E997E2AFFDD9DC9E71D7].": ".$RBA66D15CDF62D2FB4401BB274E32DCC3."</p>";     }    else     { ?>
				<p><?php echo $lang[17][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>
				<ul>
					<li><?php echo $lang[18][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
					<li><?php echo $lang[19][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
					<li><?php echo $lang[20][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
				</ul>
				
				<p><?php echo $lang[21][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></p>

				<?php     if($RAEBC944BFE29E997E2AFFDD9DC9E71D7=="pl_PL")      {      ?>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 20px 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">

					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> 20zł</option>
							<option value="Bezterminowa"><?php echo $lang[43][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> 50zł</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="currency_code" value="PLN">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/pl_PL/PL/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — Płać wygodnie i bezpiecznie">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>
					<?php      }     else      {      ?>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 0 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">
					
					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> €8,00</option>
							<option value="Bezterminowa"><?php echo $lang[43][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> €16,00</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
	
	
					<input type="hidden" name="currency_code" value="EUR">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>

					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 20px 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">
					
					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> $10,00</option>
							<option value="Bezterminowa"><?php echo $lang[43][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?> $20,00</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>
					<?php      }     ?>
				<p><?php echo $lang[25][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?><br />

					<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-pro" style="margin-left: 20px;"> 
						
						<label for 'socialslider_passht'><?php echo $lang[46][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>:</label>
						<input type='text' class='text' value='' name='socialslider_passhb' id='socialslider_passhb' style='width: 260px;' /><br style='clear: both;' />
						<input type="submit" name="SocialSliderPasshPro" value="<?php echo $lang[26][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?>" style="margin: 5px 0 25px 250px;" />
					</form>
				</p>
				<?php } ?>
			</div>
			
			<h2><?php echo $lang[28][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></h2>
			<div class="pro">
				<p><ol>
					<li><?php echo $lang[29][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
					<li><?php echo $lang[30][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
					<li><?php echo $lang[31][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
					<li><?php echo $lang[32][$RAEBC944BFE29E997E2AFFDD9DC9E71D7]; ?></li>
				</ol></p>
			</div>
			
		</div>
		<div id="ajax">&nbsp;</div>
	</div>
	<?php  }  function SocialSlider()  {  global $wpdb, $table_prefix;   $RF678211E119B8DAAE260D482291A378C  = get_bloginfo('wpurl');  $R7D1CC646E4E2E6F49016FAC2A089ACC5  = base64_decode(get_option('socialslider_licencja'));  $R6259F980F47E5686C202D2146CBB6EC4  = get_option('socialslider_tryb');  $R05AC230BF1DE92E83B8215640EB88D22   = get_option('socialslider_top');  $R6C64796A7E85747796C7665CEB9FA438  = get_option('socialslider_widget');   if(date("Y-m-d")<=base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5)) {$R7EE3BF8C9163234E4665CA2856AC61CE = "lp"; $RA7A39D80CC2809F49F1FF24BF6BD0AD6 = get_option('socialslider_widget_width'); $RC2EAFEC67EC1B83B721CF18AADF6F1A0 = get_option('socialslider_link');}  else             {$R7EE3BF8C9163234E4665CA2856AC61CE = "id"; $RA7A39D80CC2809F49F1FF24BF6BD0AD6 = "200"; $RC2EAFEC67EC1B83B721CF18AADF6F1A0 = "tak";}   if($R6259F980F47E5686C202D2146CBB6EC4=="pelny")   {   ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-<?php echo $RA7A39D80CC2809F49F1FF24BF6BD0AD6+101; ?>"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $R05AC230BF1DE92E83B8215640EB88D22; ?>px; width: <?php echo $RA7A39D80CC2809F49F1FF24BF6BD0AD6+100; ?>px; left: -<?php echo $RA7A39D80CC2809F49F1FF24BF6BD0AD6+101; ?>px;">
			<div id="socialslider-contener" class="socialslider-contener">
				<div id="socialslider-linki" class="socialslider-grupa">
					<ul>
						<?php       $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$R7EE3BF8C9163234E4665CA2856AC61CE." ASC");       foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)        {        if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><a href='".$R53B955D8243FC7B0A585BC28FFBCB5EB->adres."' title='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."'><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-32.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' />".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."</a></li>";}        }       ?>
					</ul>
				</div>

				<div id='socialslider-widget' class='socialslider-grupa' style='width: <?php echo $RA7A39D80CC2809F49F1FF24BF6BD0AD6; ?>px;'><?php echo stripslashes($R6C64796A7E85747796C7665CEB9FA438); ?></div>

				<div id="socialslider-ikony">
					<ul>
						<?php       foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)        {        if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-20.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' /></li>";}        }       ?>
					</ul>
				</div>
			</div>
			<?php    if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5) || $RC2EAFEC67EC1B83B721CF18AADF6F1A0=="tak")     { echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a> autorstwa <a href='http://xn--wicek-k0a.pl' title='Łuaksz Więcek'>Łukasza Więcka</a></div>"; }    ?>
		</div>
		<?php   }   if($R6259F980F47E5686C202D2146CBB6EC4=="uproszczony")   {   ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-86"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $R05AC230BF1DE92E83B8215640EB88D22; ?>px;">
			<div id="socialslider-linki" class="socialslider-grupa">
				<ul>
					<?php      $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$R7EE3BF8C9163234E4665CA2856AC61CE." ASC");      foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)       {       if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><a href='".$R53B955D8243FC7B0A585BC28FFBCB5EB->adres."' title='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."'><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-32.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' />".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."</a></li>";}       }      ?>
				</ul>
			</div>

			<div id="socialslider-ikony">
				<ul>
					<?php      foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)       {       if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-20.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' /></li>";}       }      ?>
				</ul>
			</div>

			<?php    if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5) || $RC2EAFEC67EC1B83B721CF18AADF6F1A0=="tak")     { echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a></div>"; }    ?>
		</div>
		<?php   }   if($R6259F980F47E5686C202D2146CBB6EC4=="kompaktowy")   {   ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-86"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $R05AC230BF1DE92E83B8215640EB88D22; ?>px;">
			<div id="socialslider-linki" class="socialslider-grupa">
				<ul>
					<?php      $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$R7EE3BF8C9163234E4665CA2856AC61CE." ASC");      foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)       {       if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><a href='".$R53B955D8243FC7B0A585BC28FFBCB5EB->adres."' title='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."'>".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."</a></li>";}       }      ?>
				</ul>
			</div>

			<div id="socialslider-ikony">
				<ul>
					<?php      foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)       {       if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-20.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' /></li>";}       }      ?>
				</ul>
			</div>

			<?php    if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5) || $RC2EAFEC67EC1B83B721CF18AADF6F1A0=="tak")     { echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a></div>"; }    ?>
		</div>
		<?php     }   if($R6259F980F47E5686C202D2146CBB6EC4=="minimalny")   {   ?>
		<div id="socialslider" class="widget widget_socialsliderwidget" style="top: <?php echo $R05AC230BF1DE92E83B8215640EB88D22; ?>px;">
			<div id="socialslider-contener" class="socialslider-contener">
				<div id="socialslider-ikony">
					<ul>
						<?php              $R9E542B1A37F053524A535CF72F7A044F = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$R7EE3BF8C9163234E4665CA2856AC61CE." ASC");       foreach ($R9E542B1A37F053524A535CF72F7A044F as $R53B955D8243FC7B0A585BC28FFBCB5EB)        {        if(!empty($R53B955D8243FC7B0A585BC28FFBCB5EB->adres)) {echo "<li><a href='".$R53B955D8243FC7B0A585BC28FFBCB5EB->adres."' title='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."'><img src='".$RF678211E119B8DAAE260D482291A378C."/wp-content/plugins/social-slider/images/".$R53B955D8243FC7B0A585BC28FFBCB5EB->ikona."-20.png' alt='".$R53B955D8243FC7B0A585BC28FFBCB5EB->nazwa."' /></a></li>";}        }              if(date("Y-m-d")>base64_decode($R7D1CC646E4E2E6F49016FAC2A089ACC5) || $RC2EAFEC67EC1B83B721CF18AADF6F1A0=="tak")        {echo "<li id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Slider</a></li>"; }       ?>
					</ul>
				</div>
			</div>
		</div>
		<?php   }  }  function SocialSliderMenu()  {  if(date("Y-m-d")<=base64_decode(base64_decode(get_option('socialslider_licencja')))) {$R00649A69C5F0DF91C60003FF666E4E22 = "Social Slider Pro";}  else                   {$R00649A69C5F0DF91C60003FF666E4E22 = "Social Slider";}   add_options_page($R00649A69C5F0DF91C60003FF666E4E22, $R00649A69C5F0DF91C60003FF666E4E22, 7, __FILE__, 'SocialSliderUstawienia');  }  function SocialSliderCSS()  {  $RB1CFD99F88A0E43B8C53F7B678602F62    = get_bloginfo('wpurl');  $R6259F980F47E5686C202D2146CBB6EC4 = get_option('socialslider_tryb');     wp_register_style("social-slider", $RB1CFD99F88A0E43B8C53F7B678602F62."/wp-content/plugins/social-slider/social-slider-".$R6259F980F47E5686C202D2146CBB6EC4.".css");  wp_enqueue_style("social-slider");    if($R6259F980F47E5686C202D2146CBB6EC4!="minimalny")   {   add_action('wp_print_scripts', 'SocialSliderJS');   }  }  function SocialSliderJS()  {  wp_enqueue_script('jquery');  }  function SocialSliderAdminHead()  {  if(date("Y-m-d")<=base64_decode(base64_decode(get_option('socialslider_licencja'))))   {   wp_enqueue_script('social-slider', '/wp-content/plugins/social-slider/social-slider.js');   }  }  add_action('admin_init', 'SocialSliderAdminHead'); add_action('admin_menu','SocialSliderMenu'); add_action('wp_print_styles', 'SocialSliderCSS'); add_action('wp_footer', 'SocialSlider'); ?>