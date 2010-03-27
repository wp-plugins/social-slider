<?php
/*
Plugin Name: Social Slider
Plugin URI: http://xn--wicek-k0a.pl/projekty/social-slider
Description: This plugin adds links to your social networking sites' profiles in a box floating at the left side of the screen.
Version: 2.5.2
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

function SocialSliderUstawienia()
	{
	global $wpdb, $table_prefix;

	$socialtabela			= $table_prefix."socialslider";
	$socialslider_baza		= get_bloginfo('wpurl');
	
	// Czy tabela istnieje?
	if($wpdb->get_var("SHOW TABLES LIKE '".$socialtabela."'") != $socialtabela)
		{
		// Tabela nie istnieje - tworzenie nowej tabeli
		$wpdb->query("CREATE TABLE  `".$socialtabela."` (`id` TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,`lp` TINYINT NOT NULL,`ikona` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`nazwa` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,`adres` VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL) ENGINE = MYISAM ;");
		$wpdb->query("ALTER TABLE  `".$socialtabela."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

		// Uzupełnienie tabeli
		$is = 1;

		$wpdb->query("INSERT INTO  `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES
			(NULL,		'".$is++."',			'rss',				'RSS',''),
			(NULL,		'".$is++."',			'newsletter',			'Newsletter',''),
			(NULL,		'".$is++."',			'sledzik',			'Ĺšledzik',''),
			(NULL,		'".$is++."',			'blip',				'Blip',''),
			(NULL,		'".$is++."',			'flaker',			'Flaker',''),
			(NULL,		'".$is++."',			'twitter',			'Twitter',''),
			(NULL,		'".$is++."',			'soup',				'Soup.io',''),
			(NULL,		'".$is++."',			'buzz',				'Buzz',''),
		
			(NULL,		'".$is++."',			'facebook',			'Facebook',''),
			(NULL,		'".$is++."',			'spinacz',			'Spinacz',''),
			(NULL,		'".$is++."',			'goldenline',			'GoldenLine',''),
			(NULL,		'".$is++."',			'linkedin',			'LinkedIn',''),
			(NULL,		'".$is++."',			'naszaklasa',			'Nasza Klasa',''),
			(NULL,		'".$is++."',			'networkedblogs',		'NetworkedBlogs',''),
			(NULL,		'".$is++."',			'myspace',			'MySpace',''),
			(NULL,		'".$is++."',			'orkut',				'Orkut',''),
						
			(NULL,		'".$is++."',			'digg',				'Digg',''),
			(NULL,		'".$is++."',			'wykop',				'Wykop',''),
			(NULL,		'".$is++."',			'kciuk',				'Kciuk',''),
			
			(NULL,		'".$is++."',			'picasa',			'Picasa',''),
			(NULL,		'".$is++."',			'flickr',			'Flickr',''),
			(NULL,		'".$is++."',			'panoramio',			'Panoramio',''),
			
			(NULL,		'".$is++."',			'youtube',			'YouTube',''),
			(NULL,		'".$is++."',			'vimeo',				'Vimeo',''),
			(NULL,		'".$is++."',			'imdb',				'IMDb',''),
			
			
			(NULL,		'".$is++."',			'lastfm',			'Last.fm',''),
			(NULL,		'".$is++."',			'ising',				'iSing',''),
			
			(NULL,		'".$is++."',			'delicious',			'Delicious','')
			;");
		}
	
	// Uaktualnienia w tabeli
		
		// Zmiana nazwy kanału RSS
		if($wpdb->get_row("SELECT nazwa FROM `".$socialtabela."` WHERE nazwa = 'KanaĹ‚ RSS'"))
			{
			$wpdb->query("UPDATE `".$socialtabela."` SET `nazwa` = 'RSS' WHERE `nazwa` = 'KanaĹ‚ RSS'");
			}

		// Dodanie serwisu Orkut
		if(!$wpdb->get_row("SELECT ikona FROM `".$socialtabela."` WHERE ikona = 'orkut'"))
			{
			$wpdb->query("INSERT INTO `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES (NULL, '27', 'orkut', 'Orkut', '')");
			}

		// Dodanie serwisu Nasza-Klasa
		if(!$wpdb->get_row("SELECT ikona FROM `".$socialtabela."` WHERE ikona = 'naszaklasa'"))
			{
			$wpdb->query("INSERT INTO `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES (NULL, '28', 'naszaklasa', 'Nasza Klasa', '')");
			}
			
		// Dodanie serwisu IMDb
		if(!$wpdb->get_row("SELECT ikona FROM `".$socialtabela."` WHERE ikona = 'imdb'"))
			{
			$wpdb->query("INSERT INTO `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES (NULL, '29', 'imdb', 'IMDb', '')");
			}
		
	// END
	
	include("language.php");

	if(WPLANG=="pl_PL")	{$la = "pl_PL";}
	else				{$la = "en_US";}

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
		if(!empty($_POST['socialslider_widget_width']))
			{
			if(get_option('socialslider_widget_width'))	{update_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}
			else										{add_option('socialslider_widget_width', $_POST['socialslider_widget_width']);}
			}
		else
			{
			if(get_option('socialslider_widget_width'))	{update_option('socialslider_widget_width', '200');}
			else										{add_option('socialslider_widget_width', '200', ' ', 'yes');}
			}
		
		// Miejsce
		if(!empty($_POST['socialslider_miejsce']))
			{
			if(get_option('socialslider_miejsce'))		{update_option('socialslider_miejsce', $_POST['socialslider_miejsce']);}
			else										{add_option('socialslider_miejsce', $_POST['socialslider_miejsce'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_miejsce'))		{update_option('socialslider_miejsce', 'lewa');}
			else										{add_option('socialslider_miejsce', 'lewa', ' ', 'yes');}
			}
		
		// Kolor
		if(!empty($_POST['socialslider_kolor']))
			{
			if(get_option('socialslider_kolor'))			{update_option('socialslider_kolor', $_POST['socialslider_kolor']);}
			else										{add_option('socialslider_kolor', $_POST['socialslider_kolor'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_kolor'))			{update_option('socialslider_kolor', 'jasny');}
			else										{add_option('socialslider_kolor', 'ciemny', ' ', 'yes');}
			}
			
		// Szybkosc
		if(!empty($_POST['socialslider_szybkosc']))
			{
			if(get_option('socialslider_szybkosc'))		{update_option('socialslider_szybkosc', $_POST['socialslider_szybkosc']);}
			else										{add_option('socialslider_szybkosc', $_POST['socialslider_szybkosc'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_szybkosc'))		{update_option('socialslider_szybkosc', 'normal');}
			else										{add_option('socialslider_szybkosc', 'normal', ' ', 'yes');}
			}
		
		// Link
		if(!empty($_POST['socialslider_link']))
			{
			if(get_option('socialslider_link'))			{update_option('socialslider_link', $_POST['socialslider_link']);}
			else										{add_option('socialslider_link', $_POST['socialslider_link'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_link'))			{update_option('socialslider_link', 'tak');}
			else										{add_option('socialslider_link', 'tak', ' ', 'yes');}
			}

		// Mobile
		if(!empty($_POST['socialslider_mobile']))
			{
			if(get_option('socialslider_mobile'))		{update_option('socialslider_mobile', $_POST['socialslider_mobile']);}
			else										{add_option('socialslider_mobile', $_POST['socialslider_mobile'], ' ', 'yes');}
			}
		else
			{
			if(get_option('socialslider_mobile'))		{update_option('socialslider_mobile', 'tak');}
			else										{add_option('socialslider_mobile', 'tak', ' ', 'yes');}
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
		if(!empty($_POST['socialslider_passhb']))
			{
			$ch = curl_init();
			$url = "http://social-slider.xn--wicek-k0a.pl/passh.php?passhb=".$_POST['socialslider_passhb']."&url=".str_replace("http://", "", get_bloginfo('url'));

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);

			$data = curl_exec($ch);
			curl_close($ch);

			if(!empty($data))
				{
				if(get_option('socialslider_licencja'))		{update_option('socialslider_licencja', $data);}
				else										{add_option('socialslider_licencja', $data, ' ', 'yes');}
				}
			else
				{
				if(get_option('socialslider_licencja'))		{delete_option('socialslider_licencja');}
				}
			}
		}
	$socialslider_licencja = base64_decode(get_option('socialslider_licencja'));
	?>
	<div class="wrap">
		<style type="text/css">
			input, textarea, select
				{
				color: #555;
				font-size: 11px;
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
				padding-left: 15px;
				border-top: 1px solid #ddd;
				border-left: 1px solid #ddd;
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
				margin: 10px 0 10px 20px;
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
			
			div.tryby
				{
				float: left;
				margin-left: 15px;
				text-align: center;
				}
			
			div.tryby img
				{
				border: 1px solid #ddd;
				height: 250px;
				}
		
		</style>

		<?php
		if(date("Y-m-d")<=base64_decode($socialslider_licencja))	{$socialslider_name = "Social Slider Pro";	$socialslider_sort = "lp";}
		else														{$socialslider_name = "Social Slider";		$socialslider_sort = "id";}
		?>

		<div id="socialslider">
			<h2><?php echo $lang[1][$la]; ?> <?php echo $socialslider_name; ?></h2>

			<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-config"> 
					
				<div class="opcja">
					<p><?php echo $lang[2][$la]; ?>:</p>
					<p class="radio" id="ss_pelny"><input type="radio" name="socialslider_tryb" id="socialslider_tryb_pelny" value="pelny"<?php if(get_option('socialslider_tryb')=="pelny" OR !get_option('socialslider_tryb')) echo " checked"; ?> /> <label for="socialslider_tryb_pelny"><?php echo $lang[3][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" id="socialslider_tryb_uproszczony" value="uproszczony"<?php if(get_option('socialslider_tryb')=="uproszczony") echo " checked"; ?> /> <label for="socialslider_tryb_uproszczony"><?php echo $lang[4][$la].$lang[57][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" id="socialslider_tryb_kompaktowy" value="kompaktowy"<?php if(get_option('socialslider_tryb')=="kompaktowy") echo " checked"; ?> /> <label for="socialslider_tryb_kompaktowy"><?php echo $lang[5][$la].$lang[58][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_tryb" id="socialslider_tryb_minimalny" value="minimalny"<?php if(get_option('socialslider_tryb')=="minimalny") echo " checked"; ?> /> <label for="socialslider_tryb_minimalny"><?php echo $lang[6][$la].$lang[59][$la]; ?></label></p>
				
					<div class="tryby" style="margin-left: 20px;"><label for="socialslider_tryb_pelny"><img style="width: 235px;" src="<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/socialslider-pelny-250.jpg" alt="<?php echo $lang[3][$la]; ?>" /><br /><?php echo $lang[3][$la]; ?></label></div>
					<div class="tryby"><label for="socialslider_tryb_uproszczony"><img style="width: 120px;" src="<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/socialslider-uproszczony-250.jpg" alt="<?php echo $lang[4][$la].$lang[57][$la]; ?>" /><br /><?php echo $lang[4][$la]; ?></label></div>
					<div class="tryby"><label for="socialslider_tryb_kompaktowy"><img style="width: 120px;" src="<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/socialslider-kompaktowy-250.jpg" alt="<?php echo $lang[5][$la].$lang[58][$la]; ?>" /><br /><?php echo $lang[5][$la]; ?></label></div>
					<div class="tryby"><label for="socialslider_tryb_minimalny"><img style="width: 120px;" src="<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/socialslider-minimalny-250.jpg" alt="<?php echo $lang[6][$la].$lang[59][$la]; ?>" /><br /><?php echo $lang[6][$la]; ?></label></div>
					
					<br style='clear: both;' />
				</div>

				<div class="opcja">
					<p><?php echo $lang[8][$la]; ?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_top')) {echo get_option('socialslider_top');} else {echo "150";} ?>" name="socialslider_top" id="socialslider_top" />px (<?php echo $lang[13][$la]; ?>: 150px)</p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[14][$la]; ?>:</p>
					<p class="radio"><input type="text" class="text" style="width: 40px;" value="<?php if(get_option('socialslider_widget_width')) {echo get_option('socialslider_widget_width');} else {echo "200";} ?>" name="socialslider_widget_width" id="socialslider_widget_width" <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo "readonly";} ?>/>px <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo " (".$lang[15][$la].")";} else {echo " (".$lang[13][$la].": 200px)";} ?></p>
				</div>
				
				<div class="opcja">
					<p><?php echo $lang[50][$la]; ?>:</p>
					<p class="radio"><input type="radio" name="socialslider_miejsce" id="socialslider_miejsce_lewa" value="lewa"<?php if(get_option('socialslider_miejsce')=="lewa" OR !get_option('socialslider_miejsce')) echo " checked"; ?> /> <label for="socialslider_miejsce_lewa"><?php echo $lang[51][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_miejsce" id="socialslider_miejsce_prawa" value="prawa"<?php if(get_option('socialslider_miejsce')=="prawa") echo " checked"; if(date("Y-m-d")>base64_decode(get_option('socialslider_licencja'))) {echo "disabled";} ?> /> <label for="socialslider_miejsce_prawa"><?php echo $lang[52][$la]; ?></label> <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo " (".$lang[15][$la].")";}?></p>
				</div>
				
				<div class="opcja" style="display: none;">
					<p><?php echo $lang[63][$la]; ?>:</p>
					<p class="radio"><input type="radio" name="socialslider_kolor" id="socialslider_kolor_jasny" value="jasny"<?php if(get_option('socialslider_kolor')=="jasny" OR !get_option('socialslider_kolor')) echo " checked"; ?> /> <label for="socialslider_kolor_jasny"><?php echo $lang[64][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_kolor" id="socialslider_kolor_ciemny" value="ciemny"<?php if(get_option('socialslider_kolor')=="ciemny") echo " checked"; if(date("Y-m-d")>base64_decode(get_option('socialslider_licencja'))) {echo "disabled";} ?> /> <label for="socialslider_kolor_ciemny"><?php echo $lang[65][$la]; ?></label> <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo " (".$lang[15][$la].")";}?></p>
				</div>
				
				<div class="opcja">
					<p><?php echo $lang[53][$la]; ?>:</p>
					<p class="radio"><input type="radio" name="socialslider_szybkosc" id="socialslider_szybkosc_slow" value="slow"<?php if(get_option('socialslider_szybkosc')=="slow") echo " checked"; ?> /> <label for="socialslider_szybkosc_slow"><?php echo $lang[54][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_szybkosc" id="socialslider_szybkosc_normal" value="normal"<?php if(get_option('socialslider_szybkosc')=="normal" OR !get_option('socialslider_szybkosc')) echo " checked"; ?> /> <label for="socialslider_szybkosc_normal"><?php echo $lang[55][$la]; ?></label></p>
					<p class="radio"><input type="radio" name="socialslider_szybkosc" id="socialslider_szybkosc_fast" value="fast"<?php if(get_option('socialslider_szybkosc')=="fast") echo " checked"; ?> /> <label for="socialslider_szybkosc_fast"><?php echo $lang[56][$la]; ?></label></p>
				</div>
				
				<div class="opcja">
					<p><?php echo $lang[36][$la]; ?>:</p>
					<p class="radio"><input type="radio" class="text" value="tak" name="socialslider_link" id="socialslider_link_tak"<?php if(get_option('socialslider_link')=="tak") echo " checked"; ?>/> <label for="socialslider_link_tak"><?php echo $lang[37][$la]; ?></label></p>
					<p class="radio"><input type="radio" class="text" value="nie" name="socialslider_link" id="socialslider_link_nie"<?php if(get_option('socialslider_link')=="nie") echo " checked"; if(date("Y-m-d")>base64_decode(get_option('socialslider_licencja'))) {echo "disabled";} ?>/> <label for="socialslider_link_nie"><?php echo $lang[38][$la]; ?></label> <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo " (".$lang[15][$la].")";}?></p>
				</div>

				<div class="opcja">
					<p><?php echo $lang[67][$la]; ?>:</p>
					<p class="radio"><input type="radio" class="text" value="tak" name="socialslider_mobile" id="socialslider_mobile_tak"<?php if(get_option('socialslider_mobile')=="tak") echo " checked"; ?>/> <label for="socialslider_mobile_tak"><?php echo $lang[37][$la]; ?></label></p>
					<p class="radio"><input type="radio" class="text" value="nie" name="socialslider_mobile" id="socialslider_mobile_nie"<?php if(get_option('socialslider_mobile')=="nie" || !get_option('socialslider_mobile')) echo " checked"; ?>/> <label for="socialslider_mobile_nie"><?php echo $lang[38][$la]; ?></label></p>
				</div>

				<div class="opcja">
				<?php
				if(date("Y-m-d")<=base64_decode($socialslider_licencja))
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
								<label for 'socialslider_".$serwis->ikona."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' />".$serwis->nazwa.":</label>
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
					
					<input type="submit" name="SocialSliderZapisz" value="<?php echo $lang[12][$la]; ?>" style="margin: 10px 0 15px 178px;" />
					
				</div>

			</form>

			<h2 id="pro"><?php echo $lang[60][$la]; ?></h2>
			<div class="pro">
				<p><?php echo $lang[61][$la]; ?></p>
				<p><?php echo $lang[62][$la]; ?>:</p>
			
				<pre style="margin-left: 20px;"><span style="color: #FF0000;">&lt;?php</span><span style="color: #333333;"> SocialSlider</span><span style="color: #AE00FB;">(); </span><span style="color: #FF0000;">?&gt;</span></pre>
			</div>
			
			<h2 id="pro"><?php echo $lang[16][$la]; ?></h2>
			<div class="pro">
			
			<?php
			if(date("Y-m-d")<=base64_decode($socialslider_licencja))
				{
				if(base64_decode($socialslider_licencja)!="2099-12-31")	{$socialslider_licencja_do = base64_decode($socialslider_licencja);}
				else													{$socialslider_licencja_do = $lang[39][$la];}

				echo "<p style='margin-left: 20px; font-style: italic;'>".$lang[40][$la].": ".$socialslider_licencja_do."</p>";
				}
			else
				{ ?>
				<p><?php echo $lang[17][$la]; ?></p>
				<ul>
					<li><?php echo $lang[18][$la]; ?></li>
					<li><?php echo $lang[19][$la]; ?></li>
					<li><?php echo $lang[20][$la]; ?></li>
				</ul>
				
				<p><?php echo $lang[21][$la]; ?></p>
				
				<?php
				if($la=="pl_PL")
					{
					$roczna = " 20zĹ‚";
					$bezter = " 50zĹ‚";
					$encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
					$curren = "PLN";
					}
				else
					{
					$roczna = " $15";
					$bezter = " $35";
					$encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
					$curren = "USD";
					}
				?>
				
				<script type="text/javascript">
					jQuery(document).ready(function()
						{
						jQuery("#waluta").change(ZmienWalute);
						});

					function ZmienWalute()
						{
						var waluta = jQuery("#waluta option:selected");
						var roczna = "";
						var bezter = "";
						var encryp = "";
						var curren = "";

						switch(waluta.val())
							{
							case "pln":
								roczna = "20zł";
								bezter = "50zł";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "PLN";
								break;

							case "usd":
								roczna = "$15";
								bezter = "$35";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "USD";
								break;
							
							case "eur":
								roczna = "€10";
								bezter = "€25";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "EUR";
								break;
							
							case "gbp":
								roczna = "£10";
								bezter = "£25";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "GBP";
								break;
							
							case "chf":
								roczna = "15 Fr.";
								bezter = "35 Fr.";
								encryp = "-----BEGIN PKCS7-----MIIHwQYJKoZIhvcNAQcEoIIHsjCCB64CAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYAQR480a9JM0Fe+kqcNxqVQSdhVveW7qqIjkSOEyKd5hAjmULVgubIqm5wOqm6rOM74v0Yw4Iuqzc0qOuCt/+OOQtmmgBUh4NRuIBJGjwJB8APWXEO0H3oMWsHqJGWdmXW63oGgr2006ZwIDVobEdII2wRejkuHCK9H8iep6XZ1RTELMAkGBSsOAwIaBQAwggE9BgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECASdA1YR5TYygIIBGPHKkFy4ozEd6wWYfl6LB2RrlqKb5qAI9FrCD2MX60YOISY/j4gjeTVdC+bj6hxt6qT11rC59htDhmJROjKVnxXBMwA9C6MISLLjZzYIymrcA6N3+v1Y3Kw/UoJ0FsjSDqav9PlJDS5ED9YsJAlRvkYgHNqt9ZLkw5nHnAxTbWYZteplOuY+IiBFqPow8LUhtFifv7SnFmhd6wwZEp/hHFNdoWl1xmtdAI66V0kP5NpbRqzx9EpBnlV09q2w0tu586hn43hsmk1ztuRVV4lBi1/7UTdM2xwQxXeNXrh4F/coZMKXiiRdwelXVZUen0uwwVAnUWyWCkUuAxv4jmtJwb5SmW60BH5PMyFsZBL2EUh5+2JHEU+qA8agggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xMDAzMjMyMzA5NDJaMCMGCSqGSIb3DQEJBDEWBBRNXvx01p/tywNdbJWXOXRALP8fnjANBgkqhkiG9w0BAQEFAASBgJmY5ii1zAUO+vGmukjgYqrdACp3VVxF68h1E+Mg++y0XsgfgHrkeo76q62Pd3WSbFSgEscRh2ASbU4Iumv1l1Ocd2xZRxeAeePG3xFutc/HN8wmgWuSdSJdEzPGpqbXYan8x46crC+EbwF6vE7FW7SqDDmZzPlspKeDLcOeqA0X-----END PKCS7-----";
								curren = "CHF";
								break;
							
							case "cad":
								roczna = "$15";
								bezter = "$35";
								encryp = "-----BEGIN PKCS7-----MIIHwQYJKoZIhvcNAQcEoIIHsjCCB64CAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYAkixHfSKhN7gvw/Iqd4HUEVPQBhBZq6YVRGdnWoWoAPd0CkwfX32D1AMZPY1f3gYubqdmkSrJc+sFOxPL44+VYGH9Yj5+h8NvpUQvqwgyGNd/9bEB8O5W4XxCvDszFkSeZZUKY5YgIZpdAYdwWVnNL0fZxdO6l+td1DA4dkHRUbTELMAkGBSsOAwIaBQAwggE9BgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECEQImtCpI1pCgIIBGBi1vBK/WlOt6BFar7L5j5vL0P8J3g2WA2c3eZ6AiIZnx95zrYKsAt++hovB286Yrx3SrjlVZJt5+fVhoi/qrNM0Xbznl1ZLYf3C+4sHSXE5V0owNJfT7Jx/LencEs9XzCbDTaa/4GlCCGxdr23HbERc68SJa7ti3Rt0Ku5pYolIs+ii0ekxS4lb7uy43+2AcyMdv9bNEw2VmK0JzUHOcaCEYES4f5S+0+ReEf9dWwAF+Y+aI5MaLOZSI2U4cUKgfGhhSdBrvTUDsWvt31hn2VUuuZlc6elv3+iy9n+6Uwhl5+/Y0NtzQvo+gJLBog7RvtCPpi9nl68heo4aAe8snwk3Asy7he8tyEhUBDGrl3s+DHXR3s39sfqgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xMDAzMjMyMzE2NDdaMCMGCSqGSIb3DQEJBDEWBBSHZXlyGvMXnnI3wZnKhwRBaxK3lDANBgkqhkiG9w0BAQEFAASBgHKmKeR06mOGmE7hHQaSkOxQmUIj08gs0lF686CkCdZIGJ0Bd+kkxFkGwZtKDAnXv5EVZocLs6w/Rg/MBUB9Y8qF0ZyI65+buXD2sl0ccFu1KqShisibKKa4ynbj2tUgigQ/wO+1IbXDUBJP5aAtgo1rwk28QYdo3ftbWL+KtfAd-----END PKCS7-----";
								curren = "CAD";
								break;
							
							case "brl":
								roczna = "R$27";
								bezter = "R$62";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "BRL";
								break;
							
							case "mxn":
								roczna = "$200";
								bezter = "$450";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "MXN";
								break;
							
							case "thb":
								roczna = "฿500";
								bezter = "฿1200";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "THB";
								break;
							
							case "aud":
								roczna = "$17";
								bezter = "$40";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "AUD";
								break;
							
							case "hkd":
								roczna = "$120";
								bezter = "$270";
								encryp = "-----BEGIN PKCS7-----MIIHwQYJKoZIhvcNAQcEoIIHsjCCB64CAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYBQZH3U9f1VxDBAMbIMVB+lWk/f9qa5yvvPpCzOO+x79Rc/jpiHK9yWpA5XQEzucxyGGMUal65C2bNSK/yysSFNFOxvCOJs9gfL/fNGOeeO4i6n80sfWRDJmGYQ4wW/SBX/ehqHw4CT13dKT1x3rWeG/Zqk/CQ5ggYS37WPWeqGCDELMAkGBSsOAwIaBQAwggE9BgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECIxXswKyFoRmgIIBGOZ5R75ShJ4dDVpEtQOo++d+7Zsz0/XrZKhsBP6vOPlobZStL6+SvLvFJ8Tga6NlHq6RtGMst61M7PH91tcMkdStP2Zc6NpWfZCv9bk0WLw+DOuTK+4gCcqnrPU9rJnAySIH3FwdPIbeM3SB/N1s3KtELPsZLPCtiJt/Y7QpuGjaxS/t8McSFAQbjzNU4sBCC/1cNhUmTx5G+bDiVydGxnTTfO1DWZrUJCQq+HNNhvqm2NSat5tLSyEKwnvEhOvYe20zGlyeBzxLpqU00Db2vESJnKjK/5JWmsL//c/V2woIvcRClukVC9+94EvwcpWndtoEKtBDwKT+yvKcT0YV+9GZlasH786ujlP2oGYjOQbcua6SF+BD2xigggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xMDAzMjQwODI4MTdaMCMGCSqGSIb3DQEJBDEWBBRbGBYcA6lrG46OrCn96QlK+1JDmjANBgkqhkiG9w0BAQEFAASBgLZMsCvRjRAdDfU/F3nrATj0qHWYZQWKxGLbqJSWotr7b93FofMdui1F8LK+X6YYexxISTdJdYGmgo9JLx+NU+tQNWKfAY+I2KV3+MsRj01cccsrQa8sBZqxXQhyVEZUyFJLYzqzo2hPXn9oHT7+9keuvI7o+JpF4bx5ma1B4VdN-----END PKCS7-----";
								curren = "HKD";
								break;
							
							case "nzd":
								roczna = "$20";
								bezter = "$50";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "NZD";
								break;
							
							case "sgd":
								roczna = "$20";
								bezter = "$50";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "SGD";
								break;
							
							case "huf":
								roczna = "3000";
								bezter = "10000";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "HUF";
								break;
							
							case "jpy":
								roczna = "¥1300";
								bezter = "¥3000";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "JPY";
								break;
							
							case "czk":
								roczna = "300";
								bezter = "700";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "CZK";
								break;
							
							case "dkk":
								roczna = "80";
								bezter = "200";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "DKK";
								break;
							
							case "nok":
								roczna = "80";
								bezter = "200";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "NOK";
								break;
							
							case "sek":
								roczna = "100";
								bezter = "250";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "SEK";
								break;
							
							case "twd":
								roczna = "NT$450";
								bezter = "NT$1100";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "TDW";
								break;
							
							case "ils":
								roczna = "55";
								bezter = "130";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "ILS";
								break;
							
							case "php":
								roczna = "P700";
								bezter = "P1500";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "PHP";
								break;
							
							case "brl":
								roczna = "R$25";
								bezter = "R$62";
								encryp = "-----BEGIN PKCS7-----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-----END PKCS7-----";
								curren = "BRL";
								break;
							}

						jQuery("#roczna").text("<?php echo $lang[42][$la]; ?> "+roczna);
						jQuery("#bezter").text("<?php echo $lang[43][$la]; ?> "+bezter);
						jQuery("#currency_code").attr("value", curren);
						jQuery("#encrypted").attr("value", encryp);
						
						}
				</script>

				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 20px 20px;">
				<input type="hidden" name="cmd" value="_s-xclick">

				<label for 'waluta'><?php echo $lang[66][$la]; ?>:</label>
					<select name="waluta" id="waluta" style='width: 260px;'>
						<option value="pln"<?php if($la=="pl_PL") echo " selected"; ?>>PLN</option>
						<option value="usd"<?php if($la!="pl_PL") echo " selected"; ?>>USD</option>
						<option value="eur">EUR</option>
						<option value="gbp">GBP</option>
						<option value="chf">CHF</option>
						<option value="cad">CAD</option>
						<option value="brl">BRL</option>
						<option value="mxn">MXN</option>
						<option value="thb">THB</option>
						<option value="aud">AUD</option>
						<option value="hkd">HKD</option>
						<option value="nzd">NZD</option>
						<option value="sgd">SGD</option>
						<option value="huf">HUF</option>
						<option value="jpy">JPY</option>
						<option value="czk">CZK</option>
						<option value="dkk">DKK</option>
						<option value="nok">NOK</option>
						<option value="sek">SEK</option>
						<option value="tdw">TDW</option>
						<option value="ils">ILS</option>
						<option value="php">PHP</option>
						<option value="brl">BRL</option>
					</select><br style='clear: both;' />

				<input type="hidden" name="on0" value="Rodzaj licencji">
				<label for 'os0'><?php echo $lang[41][$la]; ?>:</label>
					<select name="os0" style='width: 260px;'>
						<option id="roczna" value="Roczna"><?php echo $lang[42][$la].$roczna; ?></option>
						<option id="bezter" value="Bezterminowa"><?php echo $lang[43][$la].$bezter; ?></option>
					</select><br style='clear: both;' />
				
				<input type="hidden" name="on1" value="Adres e-mail">
				<label for 'os1'><?php echo $lang[44][$la]; ?>:</label>
				<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
				
				<input type="hidden" name="on2" value="Adres bloga">
				<label for 'os2'><?php echo $lang[45][$la]; ?>:</label>
				<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
				
				<input type="hidden" name="currency_code" id="currency_code" value="<?php echo $curren; ?>">
				<input type="hidden" name="encrypted" id="encrypted" value="<?php echo $encryp; ?>">
				<input type="image" style="margin-left: 230px;" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
				<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
				</form>

				<p><?php echo $lang[25][$la]; ?><br />

					<form action="options-general.php?page=social-slider/social-slider.php" method="post" id="social-slider-pro" style="margin-left: 20px;"> 
						
						<label for 'socialslider_passht'><?php echo $lang[46][$la]; ?>:</label>
						<input type='text' class='text' value='' name='socialslider_passhb' id='socialslider_passhb' style='width: 260px;' /><br style='clear: both;' />
						<input type="submit" name="SocialSliderPasshPro" value="<?php echo $lang[26][$la]; ?>" style="margin: 5px 0 25px 250px;" />
					</form>
				</p>
				<?php } ?>
			</div>
			
			<h2><?php echo $lang[28][$la]; ?></h2>
			<div class="pro">
				<p><ol>
					<li><?php echo $lang[29][$la]; ?></li>
					<li><?php echo $lang[49][$la]; ?></li>
					<li><?php echo $lang[30][$la]; ?></li>
					<li><?php echo $lang[31][$la]; ?></li>
					<li><?php echo $lang[32][$la]; ?></li>
				</ol></p>
			</div>
			<p style="margin-top: 30px;"><?php echo $lang[35][$la]; ?></p>
		</div>
		<div id="ajax">&nbsp;</div>
	</div>
	<?php
	}

function SocialSlider()
	{
	global $wpdb, $table_prefix;

	$socialslider_baza			= get_bloginfo('wpurl');
	$socialslider_licencja		= base64_decode(get_option('socialslider_licencja'));
	$socialslider_tryb			= get_option('socialslider_tryb');
	$socialslider_top			= get_option('socialslider_top');
	$socialslider_widget		= get_option('socialslider_widget');
	$socialslider_szybkosc		= get_option('socialslider_szybkosc');
	
	if(empty($socialslider_szybkosc))	{$socialslider_szybkosc = "normal";}

	if(date("Y-m-d")<=base64_decode($socialslider_licencja))
		{
		$socialslider_sort			= "lp";
		$socialslider_widget_width	= get_option('socialslider_widget_width');
		$socialslider_link			= get_option('socialslider_link');
		$socialslider_miejsce		= get_option('socialslider_miejsce');
		//$socialslider_kolor		= get_option('socialslider_kolor');
		$socialslider_kolor			= "jasny";
		}
	else
		{
		$socialslider_sort			= "id";
		$socialslider_widget_width	= "200";
		$socialslider_link			= "tak";
		$socialslider_miejsce		= "lewa";
		$socialslider_kolor			= "jasny";
		}

	switch($socialslider_kolor)
		{
		case "jasny":
			$socialslider_bg_color		= "#fff";
			$socialslider_border_color	= "#ccc";
			$socialslider_a_color		= "#666";
			$socialslider_autor_color	= "#2275ad";
			break;
		
		case "ciemny":
			$socialslider_bg_color		= "#222";
			$socialslider_border_color	= "#ccc";
			$socialslider_a_color		= "#eee";
			$socialslider_autor_color	= "#2275ad";
			break;
		}

	if($socialslider_miejsce=="lewa" || empty($socialslider_miejsce))
		{
		$socialslider_handle = "/handle-lewy";

		switch($socialslider_tryb)
			{
			case "pelny":
				$socialslider_width0		= 100+$socialslider_widget_width;
				$socialslider_width1		= 102+$socialslider_widget_width;
				$socialslider_width_js		= "left:'-".$socialslider_width1."'";
				$socialslider_width_0js		= "left:'0'";
				$socialslider_width_css		= "width: ".$socialslider_width0."px; left: -".$socialslider_width1."px; border-right: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: -32px;'";
				break;
			
			case "uproszczony":
				$socialslider_width_js		= "left:'-86'";
				$socialslider_width_0js		= "left:'0'";
				$socialslider_width_css		= "width: 85px; left: -86px; border-right: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: -32px;'";
				break;
			
			case "kompaktowy":
				$socialslider_width_js		= "left:'-86'";
				$socialslider_width_0js		= "left:'0'";
				$socialslider_width_css		= "width: 85px; left: -86px; border-right: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: -32px;'";
				break;
			
			case "minimalny":
				$socialslider_width_css		= "width: 0px; left: -1px; border-right: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: -32px;'";
				break;
			}
		}

	if($socialslider_miejsce=="prawa")
		{
		$socialslider_handle = "/handle-prawy";
		
		switch($socialslider_tryb)
			{
			case "pelny":
				$socialslider_width0		= 100+$socialslider_widget_width;
				$socialslider_width1		= 102+$socialslider_widget_width;
				$socialslider_width_js		= "right:'-".$socialslider_width1."'";
				$socialslider_width_0js		= "right:'0'";
				$socialslider_width_css		= "width: ".$socialslider_width0."px; right: -".$socialslider_width1."px; border-left: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: ".$socialslider_width0."px;'";
				break;
			
			case "uproszczony":
				$socialslider_width_js		= "right:'-88'";
				$socialslider_width_0js		= "right:'0'";
				$socialslider_width_css		= "width: 85px; right: -88px; border-left: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: 85px;'";
				break;
			
			case "kompaktowy":
				$socialslider_width_js		= "right:'-88'";
				$socialslider_width_0js		= "right:'0'";
				$socialslider_width_css		= "width: 85px; right: -88px; border-left: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony	= "style='right: 85px;'";
				break;
			
			case "minimalny":
				$socialslider_width_css		= "width: 0px; right: -1px; border-left: 1px solid ".$socialslider_border_color."; border-top: 1px solid ".$socialslider_border_color."; border-bottom: 1px solid ".$socialslider_border_color."; background-color: ".$socialslider_bg_color.";";
				$socialslider_width_ikony		= "style='right: 0;'";
				break;
			}
		}

	$serwisy = $wpdb->get_results("SELECT * FROM ".$table_prefix."socialslider WHERE adres!='' ORDER BY ".$socialslider_sort." ASC");
	?>

	<script type="text/javascript"> 
			jQuery(document).ready(function () {var hideDelay=200;var hideDelayTimer=null;jQuery("#socialslider").hover(function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);jQuery("#socialslider").animate({<?php echo $socialslider_width_0js; ?>},"<?php echo $socialslider_szybkosc; ?>");},function(){if(hideDelayTimer)clearTimeout(hideDelayTimer);hideDelayTimer=setTimeout(function(){hideDelayTimer=null;jQuery("#socialslider").animate({<?php echo $socialslider_width_js; ?>},"<?php echo $socialslider_szybkosc; ?>");},hideDelay);});});
	</script>
	<style type="text/css">
		#socialslider-ikony			{background: url('<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/<?php echo $socialslider_handle; ?>.png') no-repeat right top;}
		#socialslider-ikony ul			{background: url('<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/<?php echo $socialslider_handle; ?>.png') no-repeat right bottom;}
		* html #socialslider-ikony		{background: url('<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/<?php echo $socialslider_handle; ?>.gif') no-repeat right top;}
		* html #socialslider-ikony ul	{background: url('<?php echo $socialslider_baza; ?>/wp-content/plugins/social-slider/images/<?php echo $socialslider_handle; ?>.gif') no-repeat right bottom;}
	</style>
	
	<div id="socialslider" style="top: <?php echo $socialslider_top; ?>px; <?php echo $socialslider_width_css; ?>">
		<div id="socialslider-contener" class="socialslider-contener">
			
			<?php
			if($socialslider_tryb!="minimalny")
				{
				?>
				<div id="socialslider-linki" class="socialslider-grupa">
					<ul>
						<?php
						if($socialslider_tryb!="kompaktowy")
							{
							foreach ($serwisy as $serwis) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."' style='color: ".$socialslider_a_color.";'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-32.png' alt='".$serwis->nazwa."' />".$serwis->nazwa."</a></li>";}
							}
						else
							{
							foreach ($serwisy as $serwis) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."' style='color: ".$socialslider_a_color.";'>".$serwis->nazwa."</a></li>";}
							}
						
						if($socialslider_tryb!="minimalny" && (date("Y-m-d")>base64_decode($socialslider_licencja) || $socialslider_link=="tak"))
							{
							echo "<li id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider' style='color: ".$socialslider_autor_color.";'>Social Slider</a></li>";
							}
						?>
					</ul>
				</div>
				<?php
				}

			if($socialslider_tryb=="pelny" && !empty($socialslider_widget)) echo "<div id='socialslider-widget' class='socialslider-grupa' style='width: ".$socialslider_widget_width."px;'>".stripslashes($socialslider_widget)."</div>";
			?>
			<div id="socialslider-ikony"<?php echo $socialslider_width_ikony; ?>>
				<ul>
				<?php
				if($socialslider_tryb=="minimalny")
					{
					foreach ($serwisy as $serwis) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></a></li>";}
					
					if(date("Y-m-d")>base64_decode($socialslider_licencja) || $socialslider_link=="tak")
						{
						echo "<li id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider' style='color: ".$socialslider_autor_color.";'>Slider</a></li>";
						}
					}
				else
					{
					foreach ($serwisy as $serwis) {echo "<li><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></li>";}
					}
				?>
				</ul>
			</div>
		</div>
	</div>
		
	<?php
	}

function SocialSliderMenu()
	{
	if(date("Y-m-d")<=base64_decode(base64_decode(get_option('socialslider_licencja'))))	{$socialslider_name = "Social Slider Pro";}
	else																					{$socialslider_name = "Social Slider";}

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
	if(date("Y-m-d")<=base64_decode(base64_decode(get_option('socialslider_licencja'))))
		{
		wp_enqueue_script('social-slider', '/wp-content/plugins/social-slider/social-slider.js');
		}
	}

add_action('admin_init', 'SocialSliderAdminHead');
add_action('admin_menu','SocialSliderMenu');

if(get_option('socialslider_mobile')=="nie" || !get_option('socialslider_mobile'))
	{
	$useragents = array(		
		"iphone",			// Apple iPhone
		"ipod",				// Apple iPod touch
		"android",			// 1.5+ Android
		"dream",				// Pre 1.5 Android
		"cupcake",			// 1.5+ Android
		"blackberry9500",		// Storm
		"blackberry9530",		// Storm
		"mini",				// Opera Mini Experimental
		"webOS",				// Palm Pre Experimental
		"incognito",			// Other iPhone browser
		"webmate"			// Other iPhone browser
		);

	asort($useragents);
	
	$hua = $_SERVER['HTTP_USER_AGENT'];
	$mob = 0;

	foreach($useragents as $useragent)
		{if(eregi($useragent, $hua))	{$mob = 1;}}

	if($mob===0)
		{
		add_action('wp_print_styles', 'SocialSliderCSS');
		add_action('wp_footer', 'SocialSlider');
		}
	}

if(get_option('socialslider_mobile')=="tak")
	{
	add_action('wp_print_styles', 'SocialSliderCSS');
	add_action('wp_footer', 'SocialSlider');
	}

?>