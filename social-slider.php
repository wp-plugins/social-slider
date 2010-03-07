<?php
/*
Plugin Name: Social Slider
Plugin URI: http://xn--wicek-k0a.pl/projekty/social-slider
Description: Wtyczka przykleja do lewej krawędzi ekranu boks zawierający linki do profili w portalach społecznościowych.
Version: 1.0.1
Author: Łukasz Więcek
Author URI: http://xn--wicek-k0a.pl/
*/

/*
=========================================================
Licencja

Zabrania się jakichkolwiek ingerencji w kodzie wtyczki,
oraz usuwania informacji o jej autorze, bez uzyskania
jego wczesniejszej zgody.
=========================================================
*/
	
function SocialSliderPro()
	{
	$literki = array('a','b','c','d','e','f');$cyferki = array('6','3','8','9','4','1');if(!empty($_POST['socialslider_passh'])){$passh=$_POST['socialslider_passh'];}else{$passh=get_option('socialslider_passh');}if($passh!=''){if($passh == str_replace($literki, $cyferki, substr(hash_hmac('sha1', get_bloginfo('url'), 'md5'), 7, 16))){return true;}else{false;}}else{false;}
	}

if(SocialSliderPro()==true)	{$socialslider_name = "Social Slider Pro";	$socialslider_sort = "lp";}
else							{$socialslider_name = "Social Slider";		$socialslider_sort = "id";}

function SocialSliderUstawienia()
	{
	global $wpdb, $table_prefix, $socialslider_name, $socialslider_sort;

	$socialtabela = $table_prefix."socialslider";
	
	// Czy tabela istnieje?
	if($wpdb->get_var("SHOW TABLES LIKE '".$socialtabela."'") != $socialtabela)
		{
		// Tabela nie istnieje - tworzenie nowej tabeli
		$wpdb->query("CREATE TABLE  `".$socialtabela."` (`id` TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,`lp` TINYINT NOT NULL,`ikona` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`nazwa` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`adres` VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL) ENGINE = MYISAM ;");
		$wpdb->query("ALTER TABLE  `".$socialtabela."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

		// Uzupełnienie tabeli
		$is = 1;

		$wpdb->query("INSERT INTO  `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES
			(NULL,		'".$is++."',			'rss',				'Kanał RSS',			'".get_option('socialslider_rss')."'),
			(NULL,		'".$is++."',			'newsletter',			'Newsletter',			'".get_option('socialslider_newsletter')."'),
			(NULL,		'".$is++."',			'sledzik',			'Śledzik',			'".get_option('socialslider_sledzik')."'),
			(NULL,		'".$is++."',			'blip',				'Blip',				'".get_option('socialslider_blip')."'),
			(NULL,		'".$is++."',			'flaker',			'Flaker',			'".get_option('socialslider_flaker')."'),
			(NULL,		'".$is++."',			'twitter',			'Twitter',			'".get_option('socialslider_twitter')."'),
			(NULL,		'".$is++."',			'soup',				'Soup.io',			'".get_option('socialslider_soup')."'),
			(NULL,		'".$is++."',			'buzz',				'Buzz',				'".get_option('socialslider_buzz')."'),
		
			(NULL,		'".$is++."',			'facebook',			'Facebook',			'".get_option('socialslider_facebook')."'),
			(NULL,		'".$is++."',			'spinacz',			'Spinacz',			'".get_option('socialslider_spinacz')."'),
			(NULL,		'".$is++."',			'goldenline',			'GoldenLine',			'".get_option('socialslider_goldenline')."'),
			(NULL,		'".$is++."',			'naszaklasa',			'Nasza Klasa',		'".get_option('socialslider_naszaklasa')."'),
			(NULL,		'".$is++."',			'networkedblogs',		'NetworkedBlogs',		'".get_option('socialslider_networkedblogs')."'),
			(NULL,		'".$is++."',			'myspace',			'MySpace',			'".get_option('socialslider_myspace')."'),
			(NULL,		'".$is++."',			'digg',				'Digg',				'".get_option('socialslider_digg')."'),
			(NULL,		'".$is++."',			'wykop',				'Wykop',				'".get_option('socialslider_wykop')."'),
			(NULL,		'".$is++."',			'kciuk',				'Kciuk',				'".get_option('socialslider_kciuk')."'),
			
			(NULL,		'".$is++."',			'picasa',			'Picasa',			'".get_option('socialslider_picasa')."'),
			(NULL,		'".$is++."',			'flickr',			'Flickr',			'".get_option('socialslider_flickr')."'),
			(NULL,		'".$is++."',			'panoramio',			'Panoramio',			'".get_option('socialslider_panoramio')."'),
			
			(NULL,		'".$is++."',			'youtube',			'YouTube',			'".get_option('socialslider_youtube')."'),
			(NULL,		'".$is++."',			'vimeo',				'Vimeo',				'".get_option('socialslider_vimeo')."'),
			
			(NULL,		'".$is++."',			'lastfm',			'Last.fm',			'".get_option('socialslider_lastfm')."'),
			(NULL,		'".$is++."',			'ising',				'iSing',				'".get_option('socialslider_ising')."'),
			
			(NULL,		'".$is++."',			'delicious',			'Delicious',			'".get_option('socialslider_delicious')."')
			;");
		
		// Czyszczenie tabeli _options
		delete_option('socialslider_rss');
		delete_option('socialslider_newsletter');
		delete_option('socialslider_sledzik');
		delete_option('socialslider_blip');
		delete_option('socialslider_flaker');
		delete_option('socialslider_twitter');
		delete_option('socialslider_soup');
		delete_option('socialslider_buzz');
		
		delete_option('socialslider_facebook');
		delete_option('socialslider_spinacz');
		delete_option('socialslider_goldenline');
		delete_option('socialslider_naszaklasa');
		delete_option('socialslider_networkedblogs');
		delete_option('socialslider_myspace');
		delete_option('socialslider_digg');
		delete_option('socialslider_wykop');
		delete_option('socialslider_kciuk');
		
		delete_option('socialslider_picasa');
		delete_option('socialslider_flickr');
		delete_option('socialslider_panoramio');
		
		delete_option('socialslider_youtube');
		delete_option('socialslider_vimeo');
		
		delete_option('socialslider_lastfm');
		delete_option('socialslider_ising');
		
		delete_option('socialslider_delicious');
		}

	include("language.php");

	if(WPLANG=="pl_PL")	{$la = "pl_PL";}
	else					{$la = "pl_PL";}

	if($_POST['SocialSliderZapisz'])
		{
		// Serwisy
		$serwisy = $wpdb->get_results("SELECT * FROM ".$socialtabela."");

		foreach ($serwisy as $serwis)
			{
			$input = "socialslider_".$serwis->ikona;
			
			$wpdb->query("UPDATE `".$socialtabela."` SET `adres` = '".$_POST[$input]."' WHERE `ikona` = '".$serwis->ikona."'");
			}
		
		// Widget
		if(!empty($_POST['socialslider_widget']))
			{
			if(get_option('socialslider_widget'))		{update_option('socialslider_widget', $_POST['socialslider_widget']);}
			else										{add_option('socialslider_widget', $_POST['socialslider_widget']);}
			}
		else
			{
			if(get_option('socialslider_widget'))		{delete_option('socialslider_widget');}
			}

		// Widget width
		if(!empty($_POST['socialslider_widget_width']) && SocialSliderPro()==true)
			{
			if(get_option('socialslider_widget_width'))	{update_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}
			else										{add_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}
			}
		else
			{
			if(get_option('socialslider_widget_width'))	{update_option('socialslider_widget_width', '200');}
			else										{add_option('socialslider_widget_width', '200', ' ', 'yes');}
			}

		// Top
		if(!empty($_POST['socialslider_top']))
			{
			if(get_option('socialslider_top'))			{update_option('socialslider_top', $_POST['socialslider_top']);}
			else										{add_option('socialslider_top', $_POST['socialslider_top'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_top'))			{update_option('socialslider_top', '150');}
			else										{add_option('socialslider_top', '150', ' ', 'yes');}
			}
		
		// Tryb
		if(!empty($_POST['socialslider_tryb']))
			{
			if(get_option('socialslider_tryb'))			{update_option('socialslider_tryb', $_POST['socialslider_tryb']);}
			else										{add_option('socialslider_tryb', $_POST['socialslider_tryb'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_tryb'))			{delete_option('socialslider_tryb');}
			}
		}
	
	if($_POST['SocialSliderPasshPro'])
		{
		if(!empty($_POST['socialslider_passh']))
			{
			if(get_option('socialslider_passh'))		{update_option('socialslider_passh', $_POST['socialslider_passh']);}
			else										{add_option('socialslider_passh', $_POST['socialslider_passh'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_passh'))		{delete_option('socialslider_passh');}
			}
		}

	?>
	<div class="wrap">
		<style type="text/css">
			input, textarea
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
				width: 100px;
				float: left;
				}

			ul.serwisy label img
				{
				margin-right: 5px;
				vertical-align: middle;
				width: 20px;
				height: 20px;
				}

			ul.serwisy input, ul.serwisy textarea, div.pro input.text
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
			
			div.pro input.text
				{
				margin-right: 340px;
				}

			div.pro ul
				{
				list-style-type: circle;
				margin: 0 0 40px 20px;
				}
		
		</style>
		
		<div id="socialslider">
			<h2><?php echo $lang[1][$la]; ?> <?php echo $socialslider_name; ?></h2>

			<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-config"> 

				<div class="opcja">
					<p><?php echo $lang[2][$la]; ?>:</p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="pelny"<?php if(get_option('socialslider_tryb')=="pelny" OR !get_option('socialslider_tryb')) echo " checked"; ?> /> <?php echo $lang[3][$la]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="uproszczony"<?php if(get_option('socialslider_tryb')=="uproszczony") echo " checked"; ?> /> <?php echo $lang[4][$la]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="kompaktowy"<?php if(get_option('socialslider_tryb')=="kompaktowy") echo " checked"; ?> /> <?php echo $lang[5][$la]; ?></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" value="minimalny"<?php if(get_option('socialslider_tryb')=="minimalny") echo " checked"; ?> /> <?php echo $lang[6][$la]; ?></p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[8][$la]; ?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_top')) {echo get_option('socialslider_top');} else {echo "150";} ?>" name="socialslider_top" id="socialslider_top" />px (<?php echo $lang[13][$la]; ?>: 150px)</p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[14][$la]; if(SocialSliderPro()!=true) {echo " (".$lang[15][$la].")";}?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_widget_width')) {echo get_option('socialslider_widget_width');} else {echo "200";} ?>" name="socialslider_widget_width" id="socialslider_widget_width" <?php if(SocialSliderPro()!=true) {echo "readonly";} ?>/>px (<?php echo $lang[13][$la]; ?>: 200px)</p>
				</div>

				<div class="opcja">
				<?php
				if(SocialSliderPro()==true)
					{
					?>
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

					<p><?php echo $lang[9][$la]; ?></p>
					<ul id="serwisy" class="serwisy">
						<?php
						$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$socialslider_sort." ASC");
						foreach ($serwisy as $serwis)
							{
							echo "<li id='rA_".$serwis->id."'>
								<label for 'socialslider_".$serwis->ikona."'><img src='/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' />".$serwis->nazwa.":</label>
								<input type='text' class='text' value='".$serwis->adres."' name='socialslider_".$serwis->ikona."' id='socialslider_".$serwis->ikona."' /><br style='clear: both;' />
							</li>";
							}
						?>
					</ul>
					<ul class="serwisy">
						<li>
							<label for 'socialslider_widget'><img src='/wp-content/plugins/social-slider/images/widget-20.png' alt='Widget' /> <?php echo $lang[10][$la]; ?>:</label>
							<textarea name="socialslider_widget" id="socialslider_widget" style="height: 200px;"><?php echo stripslashes(get_option('socialslider_widget')); ?></textarea>
						</li>
						<br style='clear: both;' />
					</ul>
					<input type="submit" name="SocialSliderZapisz" value="<?php echo $lang[12][$la]; ?>" style="margin: 5px 0 15px 178px;" />
				</div>

			</form>
			
			<h2 id="pro"><?php echo $lang[16][$la]; ?></h2>
			<div class="pro">
				<p><?php echo $lang[17][$la]; ?></p>
				<ul>
					<li><?php echo $lang[18][$la]; ?></li>
					<li><?php echo $lang[19][$la]; ?></li>
					<li><?php echo $lang[20][$la]; ?></li>
				</ul>
				
				<p><?php echo $lang[21][$la]; ?></p>
			
				<p><?php echo $lang[22][$la]; ?>:</p>
				
				<p style="margin: 0 0 40px 20px;"><i>Łukasz Więcek<br/>
				65-140 Zielona Góra<br />
				ul. Wyczółkowskiego 79<br />
				<?php echo $lang[23][$la]; ?>: 56 2490 0005 0000 4000 3942 3228 (Alior Bank)<br />
				<?php echo $lang[24][$la]; ?>: <?php echo str_replace("http://", "", get_bloginfo('url')); ?></i></p>

				<p><?php echo $lang[25][$la]; ?><br />

				<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-pro" style="margin-left: 20px;"> 
					
					<label for 'socialslider_passh'>Klucz:</label>
					<input type='text' class='text' value='<?php echo get_option('socialslider_passh'); ?>' name='socialslider_passh' id='socialslider_passh' style='width: 300px;' /><br style='clear: both;' />
							
					<input type="submit" name="SocialSliderPasshPro" value="<?php echo $lang[26][$la]; ?>" style="margin: 5px 0 25px 230px;" />
				</form>
				</p>
				

				<p><?php echo $lang[27][$la]; ?><br />

					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin-left: 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">

					<label for 'os0'><input type="hidden" name="on0" value="Adres e-mail"><?php echo $lang[33][$la]; ?>:</label>
					<input type="text" name="os0" maxlength="60" class='text' style='width: 300px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<label for 'os1'><input type="hidden" name="on1" value="Adres bloga"><?php echo $lang[34][$la]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 300px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
		
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input style="margin-left: 235px;" type="image" src="https://www.paypal.com/pl_PL/PL/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — Płać wygodnie i bezpiecznie">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>
				</p>
			</div>
			
			<h2><?php echo $lang[28][$la]; ?></h2>
			<div class="pro">
				<p><ol>
					<li><?php echo $lang[29][$la]; ?></li>
					<li><?php echo $lang[35][$la]; ?></li>
					<li><?php echo $lang[30][$la]; ?></li>
					<li><?php echo $lang[31][$la]; ?></li>
					<li><?php echo $lang[32][$la]; ?></li>
				</ol></p>
			</div>
			
		</div>
		<div id="ajax">&nbsp;</div>
	</div>
	<?php
	}

function SocialSlider()
	{
	global $wpdb, $table_prefix, $socialslider_name, $socialslider_sort;

	$socialslider_baza		= get_bloginfo('wpurl');
	$socialslider_tryb		= get_option('socialslider_tryb');
	$socialslider_top			= get_option('socialslider_top');
	$socialslider_widget		= get_option('socialslider_widget');
	$socialslider_widget_width	= get_option('socialslider_widget_width');

	if($socialslider_tryb=="pelny")
		{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-<?php echo $socialslider_widget_width+101; ?>"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $socialslider_top; ?>px; width: <?php echo $socialslider_widget_width+100; ?>px; left: -<?php echo $socialslider_widget_width+101; ?>px;">
			<div id="socialslider-contener" class="socialslider-contener">
				<div id="socialslider-linki" class="socialslider-grupa">
					<ul>
						<?php
						$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$socialslider_sort." ASC");
						foreach ($serwisy as $serwis)
							{
							if(!empty($serwis->adres)) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-32.png' alt='".$serwis->nazwa."' />".$serwis->nazwa."</a></li>";}
							}
						?>
					</ul>
				</div>

				<div id='socialslider-widget' class='socialslider-grupa' style='width: <?php echo $socialslider_widget_width; ?>px;'><?php echo stripslashes($socialslider_widget); ?></div>

				<div id="socialslider-ikony">
					<ul>
						<?php
						foreach ($serwisy as $serwis)
							{
							if(!empty($serwis->adres)) {echo "<li><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></li>";}
							}
						?>
					</ul>
				</div>
			</div>
			<?php
			if(SocialSliderPro()!=true)
				{ echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a> autorstwa <a href='http://xn--wicek-k0a.pl' title='Łuaksz Więcek'>Łukasza Więcka</a></div>"; }
			?>
		</div>
		<?php
		}

	if($socialslider_tryb=="uproszczony")
		{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-86"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $socialslider_top; ?>px;">
			<div id="socialslider-linki" class="socialslider-grupa">
				<ul>
					<?php
					$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$socialslider_sort." ASC");
					foreach ($serwisy as $serwis)
						{
						if(!empty($serwis->adres)) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-32.png' alt='".$serwis->nazwa."' />".$serwis->nazwa."</a></li>";}
						}
					?>
				</ul>
			</div>

			<div id="socialslider-ikony">
				<ul>
					<?php
					foreach ($serwisy as $serwis)
						{
						if(!empty($serwis->adres)) {echo "<li><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></li>";}
						}
					?>
				</ul>
			</div>

			<?php
			if(SocialSliderPro()!=true)
				{ echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a></div>"; }
			?>
		</div>
		<?php
		}

	if($socialslider_tryb=="kompaktowy")
		{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {var hideDelay=0;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({left:"0"},"medium");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({left:"-86"},"medium");},hideDelay);});});
		</script>

		<div id="socialslider" style="top: <?php echo $socialslider_top; ?>px;">
			<div id="socialslider-linki" class="socialslider-grupa">
				<ul>
					<?php
					$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$socialslider_sort." ASC");
					foreach ($serwisy as $serwis)
						{
						if(!empty($serwis->adres)) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'>".$serwis->nazwa."</a></li>";}
						}
					?>
				</ul>
			</div>

			<div id="socialslider-ikony">
				<ul>
					<?php
					foreach ($serwisy as $serwis)
						{
						if(!empty($serwis->adres)) {echo "<li><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></li>";}
						}
					?>
				</ul>
			</div>

			<?php
			if(SocialSliderPro()!=true)
				{ echo "<div id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Social Slider</a></div>"; }
			?>
		</div>
		<?php		
		}

	if($socialslider_tryb=="minimalny")
		{
		?>
		<div id="socialslider" class="widget widget_socialsliderwidget" style="top: <?php echo $socialslider_top; ?>px;">
			<div id="socialslider-contener" class="socialslider-contener">
				<div id="socialslider-ikony">
					<ul>
						<?php
						// Odczytanie listy serwisów
						$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider ORDER BY ".$socialslider_sort." ASC");
						foreach ($serwisy as $serwis)
							{
							if(!empty($serwis->adres)) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></a></li>";}
							}
						
						if(SocialSliderPro()!=true)
							{echo "<li id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider'>Slider</a></li>"; }
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php
		}
	}

function SocialSliderMenu()
	{
	global $socialslider_name;
	add_options_page($socialslider_name, $socialslider_name, 7, __FILE__, 'SocialSliderUstawienia');
	}

function SocialSliderCSS()
	{
	$baza				= get_bloginfo('wpurl');
	$socialslider_tryb	= get_option('socialslider_tryb');
		
	wp_register_style("social-slider", $baza."/wp-content/plugins/social-slider/social-slider-".$socialslider_tryb.".css");
	wp_enqueue_style("social-slider");
	
	if($socialslider_tryb!="minimalny")
		{
		add_action('wp_print_scripts', 'SocialSliderJS');
		}
	}

function SocialSliderJS()
	{
	wp_enqueue_script('jquery');
	}

function SocialSliderAdminHead()
	{
	if(SocialSliderPro()==true)
		{
		wp_enqueue_script('social-slider', '/wp-content/plugins/social-slider/social-slider.js');
		}
	}

add_action('admin_init', 'SocialSliderAdminHead');
add_action('admin_menu','SocialSliderMenu');
add_action('wp_print_styles', 'SocialSliderCSS');
add_action('wp_footer', 'SocialSlider');
?>