<?php 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <?php
    global $user;
    global $base_url;


    if ($user->uid) {
//
    }  else
      $loggedtheme="";
    ?>

    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <?php print $styles ?>
    <?php print $scripts ?>
    <!--[if lt IE 7]>
    <?php print phptemplate_get_ie_styles(); ?>
    <![endif]-->
  </head>
  <body <?php print phptemplate_body_class($left, $right); ?>>
    <?php
    $wrapper = 'width:450px; border:none !important';
    $container = 'width:400px; border:none !important';
    if(($node->type != 'software_approval_unavailable') && (arg(2)!="software-approval-unavailable") && ($node->type != 'person_application_role') && (arg(2)!="person-application-role") && ($node->type != 'person_training_record') && (arg(2)!="person-training-record") && (arg(1)!="userinfo") && ((arg(2) !="roles") || arg(3)=='list' ) && ($node->type != 'roles')) {
      $wrapper = 'width:1000px';
      $container = '';
    } ?>
    <?php if(arg(2)=="history") {
      $wrapper = 'width:700px; border:none !important';
      $container = 'border:none !important';
    } ?>

    <!-- Layout -->
    <?php if(($node->type != 'software_approval_unavailable') && (arg(2)!="software-approval-unavailable") && ($node->type != 'person_application_role') && (arg(2)!="person-application-role") && ($node->type != 'person_training_record') && (arg(2)!="person-training-record") && (arg(1)!="userinfo") && ((arg(2) !="roles") || arg(3)=='list' ) && ($node->type != 'roles') && (arg(2)!="history")) { ?>
      <?php if ($loggedtheme!="true")
        echo '<div id="header-region" class="clear-block">'.$header.'<div class="user_manage">
          <a href="'.$base_url.'/covidien/admin/users/'.$user->uid.'/user_settings" id="anch_user_settings">User Settings</a>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <a href="'.$base_url.'/logout">Logout</a></div></div>';
      ?>
      <?php } ?>

    <div id="wrapper" style="<?php echo $wrapper;?>">
      <div id="container" class="clear-block"
      <?php
      if ($loggedtheme=="true")
        echo 'style="border:0px; '.$container.'"';
      else
        echo 'style="'.$container.'"';
      ?>
           >

        <!--  <div id="header">

			</div>  /header -->
        <?php if(($node->type != 'software_approval_unavailable')  && (arg(2)!="software-approval-unavailable") && ($node->type != 'person_application_role') && (arg(2)!="person-application-role") && ($node->type != 'person_training_record') && (arg(2)!="person-training-record") && (arg(1)!="userinfo") && ((arg(2) !="roles") || arg(3)=='list' ) && ($node->type != 'roles') && (arg(2)!="history")) { ?>
        <div class="head_and_menu">
          <div id="logo-floater">
              <?php
              // Prepare header
              $site_fields = array();
              if ($site_name) {
                $site_fields[] = check_plain($site_name);
              }
              if ($site_slogan) {
                $site_fields[] = check_plain($site_slogan);
              }
              $site_title = implode(' ', $site_fields);
              if ($site_fields) {
                $site_fields[0] = '<span>'. $site_fields[0] .'</span>';
              }
              $site_html = implode(' ', $site_fields);

              if (($logo || $site_title) && $loggedtheme!="true") {
                print '<h1><a href="'. $base_url .'/covidien/home" title="'. $site_title .'">';
                if ($logo) {
                  print '<img src="'. check_url($logo) .'" alt="'. $site_title .'" id="logo" />';
                }
              }
              ?>
          </div>
          <div class="left_title">
              <?php if ($site_title && $loggedtheme!="true") {
                print '<h1><a href="'. $base_url .'/covidien/home" title="'. $site_title .'">'.t('Device Management Portal');
                print '</a></h1>';
              } ?>
          </div>
          <div id="right_menu">
            <ul class="primary-links">
              <li><a  id="anch_home" class="" href="<?php print $base_url;?>/covidien/home"><?php echo t('Home'); ?></a></li>
              <li><a id="anch_devices" class="" href="<?php print $base_url;?>/covidien/device"><?php echo t('Devices'); ?></a></li>
              <li><a id="anch_reports" class="" href="<?php print $base_url.$report_url;?>"><?php echo t('Reports'); ?></a></li>
              <li><a id="anch_system_admin" class="" href="<?php print $base_url.$admin_page_url;?>"><?php echo t('Admin'); ?></a></li>
            </ul>
              <?php if (isset($secondary_links)) : ?>
                <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
              <?php endif; ?>
          </div>
        </div>
        <div align="right" style="margin-top:20px;"><?php print $pl_block; ?></div>
          <?php } ?>
        <!--<?php// if ($left): ?>
         <div id="sidebar-left" class="sidebar">
        <?php //if ($search_box): ?><div class="block block-theme"><?php //print $search_box ?></div><?php //endif; ?>
        <?php //print $left ?>
          </div>
        <?php //endif; ?> -->


        <div id="center">
          <div class="right-corner"><div class="left-corner">
              <?php //print $breadcrumb; ?>
              <?php if ($mission): print '<div id="mission">'. $mission .'</div>';
              endif; ?>
              <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">';
              endif; ?>
              <?php if ($title && $loggedtheme!="true"): print '<h2'. ($tabs ? ' class="page_title"' : '') .'>'. $title .'</h2>';
              endif; ?>
              <?php /** if ($tabs && $loggedtheme!="true" && (arg(0)!='node' && arg(2)!='edit')): print '<ul class="tabs">'. $tabs .'</ul></div>'; endif; */?>
              <div class="tabs_wrapper">
                <?php print theme('links',$custom_tabs);?>
              </div>
              <!--   <?php if ($tabs2): print '<ul class="primary_tab">'. $tabs2 .'</ul>';
              endif; ?> -->
              <?php print $help; ?>
              <div id="content-part" class="clear-block">
                <?php if ($show_messages && $messages): print '<div class="message">' . $messages . '</div>';
                endif; ?>
                <?php print $content ?>
              </div>
              <?php print $feed_icons ?>
              <div id="footer"><?php print $footer_message /*. $footer*/ ?> </div>
            </div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->

      <?php if ($right): ?>
      <div id="sidebar-right" class="sidebar">
          <?php if (!$left && $search_box): ?><div class="block block-theme"><?php print $search_box ?></div><?php endif; ?>
          <?php print $right ?>
      </div>
      <?php endif; ?>

      <!-- /container -->


    </div>
    <!-- /layout -->
    <?php
    if(($node->type != 'software_approval_unavailable') && (arg(2)!="software-approval-unavailable") && ($node->type != 'person_application_role') && (arg(2)!="person-application-role") && ($node->type != 'person_training_record') && (arg(2)!="person-training-record") && (arg(1)!="userinfo") && ((arg(2) !="roles") || arg(3)=='list' ) && ($node->type != 'roles') && (arg(2)!="history")) {
      ?>
      <?php print $closure ?>
      <?php }?>
    <noscript>
      <div align="center">
        <h2><?php echo t("JavaScript required to view this page"); ?></h2>
      </div>
      <style>
        body #center, body #admin-menu{display:none;}
      </style>
    </noscript>
  </body>
</html>