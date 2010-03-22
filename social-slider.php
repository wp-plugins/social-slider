<?php
/*
Plugin Name: Social Slider
Plugin URI: http://xn--wicek-k0a.pl/projekty/social-slider
Description: This plugin adds links to your social networking sites' profiles in a box floating at the left side of the screen.
Version: 2.3.4
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
			(NULL,		'".$is++."',			'sledzik',			'Śledzik',''),
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
			
			(NULL,		'".$is++."',			'lastfm',			'Last.fm',''),
			(NULL,		'".$is++."',			'ising',				'iSing',''),
			
			(NULL,		'".$is++."',			'delicious',			'Delicious','')
			;");
		}
	
	// Uaktualnienia w tabeli
		
		// Zmiana nazwy kanału RSS
		if($wpdb->get_row("SELECT nazwa FROM `".$socialtabela."` WHERE nazwa = 'Kanał RSS'"))
			{
			$wpdb->query("UPDATE `".$socialtabela."` SET `nazwa` = 'RSS' WHERE `nazwa` = 'Kanał RSS'");
			}

		// Dodanie serwisu Orkut
		if(!$wpdb->get_row("SELECT ikona FROM `".$socialtabela."` WHERE ikona = 'orkut'"))
			{
			$wpdb->query("INSERT INTO `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES (NULL, '27', 'orkut', 'Orkut', '')");
			}

		// Dodanie serwisu Nasza-Klasa
		if(!$wpdb->get_row("SELECT ikona FROM `".$socialtabela."` WHERE ikona = 'orkut'"))
			{
			$wpdb->query("INSERT INTO `".$socialtabela."` (`id`,`lp`,`ikona`,`nazwa`,`adres`) VALUES (NULL, '28', 'naszaklasa', 'Nasza Klasa', '')");
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
					<p class="radio"><input type="radio" class="text" value="tak" name="socialslider_link" id="socialslider_link_tak"<?php if(get_option('socialslider_link')=="tak") echo " checked"; ?> checked /> <label for="socialslider_link_tak"><?php echo $lang[37][$la]; ?></label></p>
					<p class="radio"><input type="radio" class="text" value="nie" name="socialslider_link" id="socialslider_link_nie"<?php if(get_option('socialslider_link')=="nie") echo " checked"; if(date("Y-m-d")>base64_decode(get_option('socialslider_licencja'))) {echo "disabled";} ?>/> <label for="socialslider_link_nie"><?php echo $lang[38][$la]; ?></label> <?php if(date("Y-m-d")>base64_decode($socialslider_licencja)) {echo " (".$lang[15][$la].")";}?></p>
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
								<label for 'socialslider_".$serwis->ikona."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/jasny/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' />".$serwis->nazwa.":</label>
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
					?>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 20px 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">

					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$la]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$la]; ?> 20zł</option>
							<option value="Bezterminowa"><?php echo $lang[43][$la]; ?> 50zł</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$la]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$la]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="currency_code" value="PLN">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/pl_PL/PL/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — Płać wygodnie i bezpiecznie">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>
					<?php
					}
				else
					{
					?>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 0 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">
					
					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$la]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$la]; ?> €8,00</option>
							<option value="Bezterminowa"><?php echo $lang[43][$la]; ?> €16,00</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$la]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$la]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
	
	
					<input type="hidden" name="currency_code" value="EUR">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>

					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin: 40px 0 20px 20px;">
					<input type="hidden" name="cmd" value="_s-xclick">
					
					<input type="hidden" name="on0" value="Rodzaj licencji">
					<label for 'os0'><?php echo $lang[41][$la]; ?>:</label>
						<select name="os0" style='width: 260px;'>
							<option value="Roczna"><?php echo $lang[42][$la]; ?> $10,00</option>
							<option value="Bezterminowa"><?php echo $lang[43][$la]; ?> $20,00</option>
						</select><br style='clear: both;' />
					
					<input type="hidden" name="on1" value="Adres e-mail">
					<label for 'os1'><?php echo $lang[44][$la]; ?>:</label>
					<input type="text" name="os1" maxlength="60" class='text' style='width: 260px;' value='<?php bloginfo('admin_email'); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="on2" value="Adres bloga">
					<label for 'os2'><?php echo $lang[45][$la]; ?>:</label>
					<input type="text" name="os2" maxlength="60" class='text' style='width: 260px;' value='<?php echo str_replace("http://", "", get_bloginfo('url')); ?>'><br style='clear: both;' />
					
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" style="margin-left: 245px;" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
					</form>
					<?php
					}
				?>
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
		$socialslider_handle = $socialslider_kolor."/handle-lewy";

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
		$socialslider_handle = $socialslider_kolor."/handle-prawy";
		
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
							foreach ($serwisy as $serwis) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."' style='color: ".$socialslider_a_color.";'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$socialslider_kolor."/".$serwis->ikona."-32.png' alt='".$serwis->nazwa."' />".$serwis->nazwa."</a></li>";}
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
					foreach ($serwisy as $serwis) {echo "<li><a href='".$serwis->adres."' title='".$serwis->nazwa."'><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$socialslider_kolor."/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></a></li>";}
					
					if(date("Y-m-d")>base64_decode($socialslider_licencja) || $socialslider_link=="tak")
						{
						echo "<li id='socialslider-autor'><a href='http://xn--wicek-k0a.pl/projekty/social-slider' title='Social Slider' style='color: ".$socialslider_autor_color.";'>Slider</a></li>";
						}
					}
				else
					{
					foreach ($serwisy as $serwis) {echo "<li><img src='".$socialslider_baza."/wp-content/plugins/social-slider/images/".$socialslider_kolor."/".$serwis->ikona."-20.png' alt='".$serwis->nazwa."' /></li>";}
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
add_action('wp_print_styles', 'SocialSliderCSS');
add_action('wp_footer', 'SocialSlider');
?>