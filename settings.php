<?php
	$plugin_url = plugins_url();
 if(isset($_POST['formset'])) {
   $formset = $_POST['formset'];
 } else {
	$formset = "";  
 }
 if ($formset == "1") {  //our form has been submitted let's save the values
	update_option('bluepost_bg_color', $_POST['bluepost_bg_color']);
	update_option('bluepost_bg_img', $_POST['bluepost_bg_img']);
	update_option('bluepost_bg_repeat', $_POST['bluepost_bg_repeat']);
	update_option('bluepost_bg_scroll', $_POST['bluepost_bg_scroll']);
	update_option('bluepost_radius', $_POST['bluepost_radius']);
	update_option('bluepost_link_color', $_POST['bluepost_link_color']);
	update_option('bluepost_postedby_border_color', $_POST['bluepost_postedby_border_color']);
	update_option('bluepost_text_color', $_POST['bluepost_text_color']);
	update_option('bluepost_postedby_link_color', $_POST['bluepost_postedby_link_color']);
?>
<div class="updated">
 <p><strong>
   <?php _e('Options saved.', 'om_trans_domain' ); ?>
   </strong></p>
</div>
<?php	
 }
 // let's get our saved options
   $bluepost_bg_color = get_option('bluepost_bg_color');
	$bluepost_bg_img = get_option('bluepost_bg_img');
	$bluepost_bg_repeat = get_option('bluepost_bg_repeat');
	$bluepost_bg_scroll = get_option('bluepost_bg_scroll');
	$bluepost_radius = get_option('bluepost_radius');
	$bluepost_link_color = get_option('bluepost_link_color');
	$bluepost_postedby_border_color = get_option('bluepost_postedby_border_color');
	$bluepost_postedby_link_color = get_option('bluepost_postedby_link_color');
	$bluepost_text_color = get_option('bluepost_text_color');
	
// let's write our css file
$cssfile = plugin_dir_path(__FILE__) . "css/style.css";
$fh = fopen($cssfile, 'w') or die ("can't open file");
$blizzicon = plugins_url('img/blizz_ico.gif', __FILE__);
$stringData = '@charset "utf-8";
/* CSS Document */
@import url(//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css);
.wowbq-bluequote { font-size: 12px; font-family: Verdana, sans-serif; background-color: '.$bluepost_bg_color.' !important;  background-image: url("'.$bluepost_bg_img.'"); ';
if ($bluepost_bg_repeat == "yes") { 
 $stringData .= ' background-repeat: repeat; ';
}
if ($bluepost_bg_scroll != "yes") { 
 $stringData .= ' background-attachment: fixed; ';
}
$stringData .= '-webkit-border-radius: '.$bluepost_radius.'px; -moz-border-radius: '.$bluepost_radius.'px; border-radius: '.$bluepost_radius.'px; color: '.$bluepost_text_color.' !important;	margin: 10px auto;
	padding: 0 10px 10px;	width: 95%;}
.wowbq-bluequote a { color: '.$bluepost_link_color.' !important;	text-decoration: none;	font-weight: bold;}
.wowbq-bluequote a:hover {	text-decoration: underline;}
.wowbq-postedby {	background: url("../img/blizz_ico.gif") no-repeat scroll 0 50% transparent;	padding: 10px 30px 5px;	border-bottom: 1px solid '.$bluepost_postedby_border_color.' !important;}
.wowbq-postedby a {color: '.$bluepost_postedby_link_color.' !important;}
.wowbq-clear {	clear: both;}
';
fwrite($fh, $stringData);
fclose($fh);
?>
<div id="wrap">
 <h1 class="title"><img src="<?php echo $blizzicon;?>" alt="Blizzard Quotes"/> Blizzard Quotes Settings</h1>
 <div class="optionscontainer">
   <div class="optbg">
     <form id="styleoptions" method="post" name="styleoptions">
       <button>Save</button>
       <table>
         <tr>
           <th>Blue Posts Background Color</th>
           <td><input type="text" name="bluepost_bg_color" id="bluepost_bg_color" value="<?php echo $bluepost_bg_color;?>" class="background-color"  data-default-color="#ffffff"/>
             <br/>
             Set the default background color for the blue posts.</td>
         </tr>
         <tr>
           <th>Blue Posts Background Image</th>
           <td><input type="text" name="bluepost_bg_img" id="bluepost_bg_img" value="<?php echo $bluepost_bg_img;?>"/>
             <input type="button" id="upload_media_file" value="Upload Background Image"/>
             <br/>
             Set the default background image for the blue posts.</td>
         </tr>
         <tr>
           <th>Blue Posts Background Repeat</th>
           <td><input type="checkbox" name="bluepost_bg_repeat" id="bluepost_bg_repeat" value="yes" <?php checked( $bluepost_bg_repeat, 'yes'); ?>  />
             <br/>
             Repeat the background?</td>
         </tr>
           <tr>
           <th>Blue Posts Background Scroll</th>
           <td><input type="checkbox" name="bluepost_bg_scroll" id="bluepost_bg_scroll" value="yes" <?php checked( $bluepost_bg_scroll, 'yes' ); ?>  />
             <br/>
             Scroll the background?</td>
         </tr>
         <tr>
           <th>Blue Posts Text Color</th>
           <td><input type="text" name="bluepost_text_color" id="bluepost_text_color" value="<?php echo $bluepost_text_color;?>" class="background-color"  data-default-color="#00B4FF"/>
             <br/>
             Set the default text color for the blue posts.</td>
         </tr>
         <tr>
           <th>Blue Posts Posted By Link Color</th>
           <td><input type="text" name="bluepost_postedby_link_color" id="bluepost_postedby_link_color" value="<?php echo $bluepost_postedby_link_color;?>" class="background-color"  data-default-color="#ffffff"/>
             <br/>
             Set the default posted by link color for the blue posts.</td>
         </tr>
         <tr>
           <th>Blue Posts Link Color</th>
           <td><input type="text" name="bluepost_link_color" id="bluepost_link_color" value="<?php echo $bluepost_link_color;?>" class="background-color"  data-default-color="#ffffff"/>
             <br/>
             Set the default link color for the blue posts.</td>
         </tr>
         <tr>
           <th>Blue Posts Posted By Border Color</th>
           <td><input type="text" name="bluepost_postedby_border_color" id="bluepost_postedby_border_color" value="<?php echo $bluepost_postedby_border_color;?>" class="background-color"  data-default-color="#ffffff"/>
             <br/>
             Set the default bottom border color for the posted by section.</td>
         </tr>
         <tr>
           <th>Blue Posts Radius</th>
           <td><input type="text" name="bluepost_radius" id="bluepost_radius" value="<?php echo $bluepost_radius;?>"/>
             <br/>
             Set the corner radius for the blue posts.</td>
         </tr>
       </table>
       <input type="hidden" id="formset" name="formset" value="1"/>
     </form>
   </div>
 </div>
 <div class="thanksbox">
   <div class="metabox-holder postbox">
     <h3 class="hndle"><span><?php  _e( 'Thank you for using Blizzard Quotes', 'blizzardquotes' ); ?></span></h3>
     <div class="inside blizzardquotes"> <img src="<?php echo $plugin_url;?>/blizzard-quotes/img/preview.jpg" alt="WoW Blizzard Quotes Preview" /><br/>
       <?php _e( 'Please support Plumeria Web Design so we can continue making rocking plugins for you. If you enjoy this plugin, please consider offering a small donation. We also look forward
	  to your comments and suggestions so that we may further improve our plugins to better serve you.', 'blizzardquotes' ); ?>
       <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
         <input type="hidden" name="cmd" value="_s-xclick">
         <input type="hidden" name="hosted_button_id" value="SLYFNBZU8V87W">
         <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
         <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
       </form>
     </div>
   </div>
 </div>
</div>
