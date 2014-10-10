<?php
/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
function phptemplate_body_class($left, $right) {
  if ($left != '' && $right != '') {
    $class = 'sidebars';
  }
  else {
    if ($left != '') {
      $class = 'sidebar-left';
    }
    if ($right != '') {
      $class = 'sidebar-right';
    }
  }
  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}
/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function covidien_theme_preprocess_page(&$vars) {

  global $user;
  global $base_url;

  //validate Cross site request forgery start
//  $parse_base_url = parse_url($base_url);
//  $referer = parse_url($_SERVER['HTTP_REFERER']);
//  if ($_SERVER['HTTP_REFERER'] && ($parse_base_url['host'] != $referer['host'])) {
//    drupal_goto('logout');
//    exit;
//  }
//
  //validate Cross site request forgery end
//  $node_type = '';
//  if (($user->uid) && ((arg(1) == 'register') || (arg(1) == 'forgot_password') || (arg(1) == 'reset_password'))) {
//    //drupal_goto("covidien/home");
//  } elseif ((!$user->uid) && ((arg(1) == 'register') || (arg(1) == 'forgot_password') || (arg(1) == 'reset_password'))) {
//    //drupal_goto("covidien/home");
//  } elseif (!$user->uid) {
////    $vars['template_files'][] = 'user-login';
//  } elseif ((arg(0) == "user") && (arg(1) != 'log')) {
//    drupal_goto("covidien/home");
//  }
  
  $vars['admin_page_url'] = '/covidien/admin/hardware';

}


/**
 * Add a "Comments" heading above comments except on forum pages.
 */
function covidien_theme_preprocess_comment_wrapper(&$vars) {
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 class="comments">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}
/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}
/**
 * Returns the themed submitted-by string for the comment.
 */
function phptemplate_comment_submitted($comment) {
  return t('!datetime � !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}
/**
 * Returns the themed submitted-by string for the node.
 */
function phptemplate_node_submitted($node) {
  return t('!datetime � !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}
function form_example_button($element) {
  // Make sure not to overwrite classes.
		if ($element['#type'] == 'submit') {
		  if (isset($element['#attributes']['class'])) {
			$element['#attributes']['class'] = 'form-button'. $element['#button_type'] .' Submit ';
		  }
		  else {
			$element['#attributes']['class'] = 'form-button'. $element['#button_type'];
		  
		  }	 }
		  else{		
		  // We here wrap the output with a couple span tags
		  return '<span class="button"><span><input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ')  .'id="'. $element['#id'].'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." /></span></span>\n";
		}
}
/**
 * Generates IE CSS links for LTR and RTL languages.
 */
function phptemplate_get_ie_styles() {
  global $language;
  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/fix-ie.css" />';
  if ($language->direction == LANGUAGE_RTL) {
    $iecss .= '<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/fix-ie-rtl.css";</style>';
  }
  return $iecss;
}



/**
 * Implements theme_preprocess_hook
 */
function covidien_theme_preprocess_user_login(&$variables) {
  $variables['intro_text'] = t('This is my awesome login form');
  $variables['rendered'] = drupal_render($variables['form']);
}
/**
 * Implements theme_preprocess_hook
 */
function covidien_theme_preprocess_access_role(&$variables) {
  $variables['intro_text'] = t('This is my awesome login form');
}
function covidien_theme_login_final_validate($form, &$form_state) {
  exit;
}
/**
 * Implements hook_preprocess_templatename() to render the fileds for hardware.
 */
function covidien_theme_preprocess_hardware_node_form(&$vars) {
  $vars['hardware_title'] = drupal_render($vars['form']['title']);
  $vars['hardware_device_type'] = drupal_render($vars['form']['field_device_type']);
  $vars['hardware_version'] = drupal_render($vars['form']['field_hw_version']);
  $vars['hardware_part'] = drupal_render($vars['form']['field_hw_part']);
  $vars['field_hw_description'] = drupal_render($vars['form']['field_hw_description']);
  $vars['hardware_type'] = drupal_render($vars['form']['field_hw_type']);
  $vars['hardware_delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['hardware_cancel'] = drupal_render($vars['form']['buttons']['cancel']);
  $vars['hardware_submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['hardware_render'] = drupal_render($vars['form']);
}
/**
 * Implements hook_preprocess_templatename() to render the fileds for software.
 */
function covidien_theme_preprocess_software_node_form(&$vars) {
drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  if(arg(2)=='edit'){
    drupal_set_title(t('Edit Software'));
  }else{
    drupal_set_title(t('Add New Software to Catalog'));
  }
  $vars['sw_device_type'] = drupal_render($vars['form']['field_device_type']);
  $vars['sw_title'] = drupal_render($vars['form']['title']);
  $vars['sw_part'] = drupal_render($vars['form']['field_sw_part']);
  $vars['sw_version'] = drupal_render($vars['form']['field_sw_version']);
  $vars['sw_integrity_check'] = drupal_render($vars['form']['field_sw_integrity_check']);
  $vars['sw_description'] = drupal_render($vars['form']['field_sw_description']);
  $vars['sw_language'] = drupal_render($vars['form']['field_sw_language']);
  $vars['sw_status'] = drupal_render($vars['form']['field_sw_status']);
  $vars['sw_type'] = drupal_render($vars['form']['field_sw_type']);
  $vars['sw_file'] = drupal_render($vars['form']['field_sw_file']);  
  $vars['hidden_hw_list_id'] = 'hw_listhidden';
  $output = '';
  if(!empty($vars['form']['#post'])){
    $values = $vars['form']['#post']['field_hw_list']['nid']['nid'];
	$vcount = count($values);
	if($vcount>0){
    foreach($values as $val){
      if($val>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$val.'"
	  id="edit-field-hw_list-nid-nid-'.$val.'" name="field_hw_list[nid][nid]['.$val.']">';
    }
	}
  }else{
    $values = $vars['form']['field_hw_list']['#default_value'];
	$vcount = count($values);
    for($i=0;$i<$vcount;$i++){
      if($values[$i]['nid']>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$values[$i]['nid'].'" 
	  id="edit-field-hw_list-nid-nid-'.$values[$i]['nid'].'" name="field_hw_list[nid][nid]['.$values[$i]['nid'].']">';
    }
  }
  $vars['hidden_hw_list'] = $output;
  $vars['hw_list'] = '<div id="hw_list_wraper"></div>';
  drupal_render($vars['form']['field_hw_list']);
  $vars['hw_list_filter_select'] = drupal_render($vars['form']['filter']['filter_hw_type']);
  $vars['hw_list_filter_go'] = drupal_render($vars['form']['filter']['go']);  
  $vars['form_delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['form_cancel'] = drupal_render($vars['form']['buttons']['cancel']);
  $vars['form_submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['form_render'] = drupal_render($vars['form']);
}
/**
 * Implements hook_preprocess_templatename() to render the fileds for document.
 */
function covidien_theme_preprocess_document_node_form(&$vars) {
drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  if(arg(2)=='edit'){
    drupal_set_title(t('Edit Document'));
  }else{
    drupal_set_title(t('Add New Document to Catalog'));
  }
  $vars['doc_device_type'] = drupal_render($vars['form']['field_device_type']);
  $vars['doc_title'] = drupal_render($vars['form']['title']);
  $vars['doc_part'] = drupal_render($vars['form']['field_document_part_number']);
  $vars['doc_version'] = drupal_render($vars['form']['field_document_version']);
  $vars['field_documnet_type'] = drupal_render($vars['form']['field_documnet_type']);
  $vars['field_document_file'] = drupal_render($vars['form']['field_document_file']);
  $vars['field_document_description'] = drupal_render($vars['form']['field_document_description']);
  $vars['field_document_language'] = drupal_render($vars['form']['field_document_language']);  
  $vars['hidden_doc_hw_list_id'] = 'doc_hw_listhidden';
  $output = '';
  if(!empty($vars['form']['#post'])){
    $values = $vars['form']['#post']['field_doc_hw_list']['nid']['nid'];
	$vcount = count($values);
	if($vcount>0){
    foreach($values as $val){
      if($val>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$val.'"
	  id="edit-field-doc_hw_list-nid-nid-'.$val.'" name="field_doc_hw_list[nid][nid]['.$val.']">';
    }
	}
  }else{
    $values = $vars['form']['field_doc_hw_list']['#default_value'];
	$vcount = count($values);
    for($i=0;$i<$vcount;$i++){
      if($values[$i]['nid']>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$values[$i]['nid'].'" 
	  id="edit-field-doc_hw_list-nid-nid-'.$values[$i]['nid'].'" name="field_doc_hw_list[nid][nid]['.$values[$i]['nid'].']">';
    }
  }
  $vars['hidden_doc_hw_list'] = $output;
  $vars['doc_hw_list'] = '<div id="doc_hw_list_wraper"></div>';
  drupal_render($vars['form']['field_doc_hw_list']);
  //software associate
  $vars['hidden_doc_sw_list_id'] = 'doc_sw_listhidden';
  $output = '';
  if(!empty($vars['form']['#post'])){
    $values = $vars['form']['#post']['field_doc_sw_list']['nid']['nid'];
	$vcount = count($values);
	if($vcount>0){
    foreach($values as $val){
      if($val>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$val.'"
	  id="edit-field-doc_sw_list-nid-nid-'.$val.'" name="field_doc_sw_list[nid][nid]['.$val.']">';
    }
	}
  }else{
    $values = $vars['form']['field_doc_sw_list']['#default_value'];
	$vcount = count($values);
    for($i=0;$i<$vcount;$i++){
      if($values[$i]['nid']>0)
      $output .= '<input type="checkbox" class="form-checkbox" checked="checked" value="'.$values[$i]['nid'].'" 
	  id="edit-field-doc_sw_list-nid-nid-'.$values[$i]['nid'].'" name="field_doc_sw_list[nid][nid]['.$values[$i]['nid'].']">';
    }
  }
  $vars['hidden_doc_sw_list'] = $output;
  $vars['doc_sw_list'] = '<div id="doc_sw_list_wraper"></div>';
  drupal_render($vars['form']['field_doc_sw_list']);
  $vars['sw_filter_lang'] = drupal_render($vars['form']['filter']['filter_lang']);
  $vars['sw_filter_go'] = drupal_render($vars['form']['filter']['go']);  
  $vars['hw_filter_type'] = drupal_render($vars['form']['filter']['filter_type']);
  $vars['hw_filter_go'] = drupal_render($vars['form']['filter']['filter_type_go']);  
  $vars['form_delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['form_cancel'] = drupal_render($vars['form']['buttons']['cancel']);
  $vars['form_submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['form_render'] = drupal_render($vars['form']);
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 */
function covidien_theme_preprocess_roles_node_form(&$vars) {
  global $user;
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  drupal_add_js(drupal_get_path('module', 'covidien_users') .'/js/covidien_users.js');
  $title = ($vars['form']['nid']['#value'] == "")?t("Add New Role"):t("Edit Role");
	$button_title = ($vars['form']['nid']['#value'] == "")?t("Add New Role"):t("Save Changes");
	$vars['form']['buttons']['submit']['#value']=$button_title;
  drupal_set_title($title);
  $vars['form']['field_role_product_line']['nid']['nid']['#options'][''] = "";
  $pl = $_SESSION['default_cot'];
  if($pl) {
	$vars['form']['field_role_product_line']['nid']['nid']['#value'] = $pl;
	$vars['form']['role_pl']['#value'] = $pl;
  } else {
    $vars['form']['role_pl']['#value'] = $vars['form']['field_role_product_line']['nid']['nid']['#value'];
    $pl = $vars['form']['field_role_product_line']['nid']['nid']['#value'];
  }
  $vars['form']['field_role_product_line']['nid']['nid']['#attributes'] = array('disabled' =>'disabled'); 
  if($title == "Edit Role"){
    //	$vars['form']['buttons']['submit']['#attributes'] = array('onclick'=>'if(!confirm("Do you want to save the changes you just made to this page?")){return false;}');
    $old_r =  db_result(db_query("select title from {node} where nid = '%s'",arg(1)));
    $old_role = db_result(db_query("select rid from {role} where name = '%s'",$pl."__".$old_r));
  }
  $vars['form']['field_role_product_line']['nid']['nid']['#title'] = "";
  $vars['form']['title']['#value'] = ($vars['form']['title']['#value'] == "")? "Enter role name":$vars['form']['title']['#value'];
  $vars['form']['title']['#maxlength'] = 60;
  $vars['form']['field_roles_description'][0]['value']['#maxlength'] = 250;
$vars['form']['title']['#title'] = "";
$vars['form']['field_roles_description'][0]['value']['#title'] = "";
$vars['form']['old_role']['#value'] = $old_role;
	$vars['product_line'] = drupal_render($vars['form']['field_role_product_line']);
	$vars['role_pl'] = drupal_render($vars['form']['role_pl']);
	$vars['title'] = drupal_render($vars['form']['title']);
	$vars['desc'] = drupal_render($vars['form']['field_roles_description']);
	$vars['old_role'] = drupal_render($vars['form']['old_role']);
	$vars['save'] = drupal_render($vars['form']['buttons']['submit']);
	$vars['delete'] = drupal_render($vars['form']['buttons']['delete']);
	$vars['render'] = drupal_render($vars['form']);	
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 * @todo : translation update
 */
function covidien_theme_preprocess_software_approval_unavailable_node_form(&$vars) {
  global $user;
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  $title = ($vars['form']['nid']['#value'] == "")?t("Add Regulatory Exception"):t("Delete Regulatory Exception");
  $button_title = ($vars['form']['nid']['#value'] == "")?t("Add Exception"):t("Delete Exception");  
  drupal_set_title($title);  
  $vars['form']['buttons']['submit']['#value']=$button_title;
  $roles = array_values($user->roles);
  $pl = explode("__",$roles[1]);
  $result = node_load($pl[0]);
  $vars['form']['product_line']['#value'] = $result->title;
  $vars['form']['title']['#title'] = "";
  $vars['form']['title']['#value'] = "Regulatory";
  $sw = trim(arg(3));
  $result = node_load($sw);
  $device = node_load($result->field_device_type[0]['nid']);
  $vars['device_type'] = $device->title;
  $vars['sw_name'] = $result->title;
  $vars['sw_version'] = $result->field_sw_version[0]['value'];
  $vars['sw_desc'] = $result->field_sw_description[0]['value'];
  $vars['sw_part'] = $result->field_sw_part[0]['value'];
  $vars['form']['field_reg_approved_component']['nid']['nid']['#value'] = $sw;
  $vars['form']['field_reg_approved_country']['nid']['nid']['#title'] = "";
  $vars['form']['field_reg_approved_country']['nid']['nid']['#options'][''] = "Select Country";
  $vars['country'] = drupal_render($vars['form']['field_reg_approved_country']);  
  $vars['save'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['render'] = drupal_render($vars['form']);
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 */
function covidien_theme_preprocess_user_register(&$vars) {
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  drupal_add_js(drupal_get_path('module', 'covidien_users') .'/js/covidien_users.js');
  drupal_add_css(drupal_get_path('module', 'covidien_devices') .'/css/tabs.css');
  drupal_add_js(drupal_get_path('module', 'covidien_ui') .'/js/covidien_autocomplete.js');
  $vars['form']['field_first_name'][0]['value']['#title'] = "";
  $vars['form']['field_last_name'][0]['value']['#title'] = "";
  $vars['form']['field_covidien_employee']['value']['#title'] = "";
  $vars['form']['roles']['#title'] = "";
	$submitted_roles_array = $vars['form']['roles']['#value'];
	$default_role_submitted_value = '';
	if(!empty($vars['form']['default_role']['#value'])) {
		$default_role_submitted_value = $vars['form']['default_role']['#value'];
	}
	
  $vars['form']['field_business_unit']['nid']['nid']['#title'] = "";
  $vars['form']['field_user_language']['nid']['nid']['#title'] = "";
  $vars['form']['field_business_unit']['nid']['nid']['#options'][''] = "";
	
  //Blank option at first
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
  $vars['form']['field_user_language']['nid']['nid']['#options'][''] = "";
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
  $vars['form']['submit']['#attributes'] = array('onclick'=>'$("#edit-company-account-number").attr("disabled","disabled");');  
  $vars['form']['mail']['#value'] = $vars['form']['name']['#value']; 
  $vars['form']['field_associated_party_type']['#default_value'][0]['nid']="Person";
  $vars['form']['field_device_avail_country']['nid']['nid']['#title'] = "";
	$vars['form']['field_device_avail_country']['nid']['nid']['#options'][''] = "";
	global $user;
	$productline = getAllProductlineRoles();
	$login_user_role = getUserProductlineRoles($user->uid);
	$pl = array();
	foreach($productline as $key=>$val) {
			if(array_key_exists($key,$login_user_role)) {
				$options = $vars['form']['productline'][$key]['#options'];
				$default_selected = 0;
				if(!empty($submitted_roles_array)) {
					foreach($submitted_roles_array as $k) {
						if(array_key_exists($k,$options)) {
							$vars['form']['productline'][$key]['#value'] = $k;
							if($default_role_submitted_value == $k) { $default_selected = 1; }
						}
					}
				}
				$pl[$key] = drupal_render($vars['form']['productline'][$key]);
				$privilege_key = str_replace(' ','-',$key);
				$pl[$privilege_key.'_privilege'] = drupal_render($vars['form']['productline'][$privilege_key.'_privilege']);
				if($default_selected == 1) {$pl['selected'][$key]= 1;}
				else {$pl['selected'][$key] = 0;}
			}	
	}

  $vars['mail'] = drupal_render($vars['form']['mail']);
  $vars['name'] = drupal_render($vars['form']['name']);
  $vars['pass'] = drupal_render($vars['form']['pass']);
  $vars['roles'] = drupal_render($vars['form']['roles']);
  $vars['first_name'] = drupal_render($vars['form']['field_first_name']);
  $vars['last_name'] = drupal_render($vars['form']['field_last_name']);
  $vars['language'] = drupal_render($vars['form']['field_user_language']);
  $vars['business_unit'] = drupal_render($vars['form']['field_business_unit']);
  $vars['covidien_user'] = drupal_render($vars['form']['field_covidien_employee']);
  $vars['delete'] = drupal_render($vars['form']['delete']);
  $vars['cancel'] = drupal_render($vars['form']['cancel']);
  $vars['submit'] = drupal_render($vars['form']['submit']);
  $vars['form_token'] = drupal_render($vars['form']['form_token']);
  $vars['form_build_id'] = drupal_render($vars['form']['form_build_id']);
  $vars['form_id'] = drupal_render($vars['form']['form_id']);
  $vars['destination'] = drupal_render($vars['form']['destination']);
  $vars['timezone'] = drupal_render($vars['form']['timezone']);
  $vars['other_company'] = drupal_render($vars['form']['customer_name']);
  $vars['country'] = drupal_render($vars['form']['field_device_avail_country']);
  $vars['company_account_number'] = drupal_render($vars['form']['account_number']);
	$vars['device_type_array'] = drupal_render($vars['form']['device_type_array']);
	$vars['role_access_array'] = drupal_render($vars['form']['role_access_array']);
	$vars['role_name_array'] = drupal_render($vars['form']['role_name_array']);
	$vars['selected_device_array'] = $vars['form']['device_type_array']['#value'];
	$vars['selected_access_array'] = $vars['form']['role_access_array']['#value'];
	$vars['selected_role_array'] = $vars['form']['role_name_array']['#value'];
  $vars['default_role'] = drupal_render($vars['form']['default_role']);
	$vars['productline'] = $login_user_role;
  $vars['pl'] = $pl;
}
/**
 * Helper function
 * used in covidien_theme_preprocess_person_node_form, covidien_theme_preprocess_user_register
 */
function getAccountNames($var) {
  if(empty($var)) { return array(''=>''); }
  $view = views_get_view('account_number_map_customer_file');
  $view->init_display();
  $view->pre_execute(array($var));
  $view->execute();
  $result = $view->result;
  $array['']='';
  if(count($result)>0){
    foreach($result as $rec){
	  $nid = $rec->nid;
	  $account = $rec->node_data_field_customer_party_pk_field_bu_customer_account_number_value;
	  $array[$nid] = $account;
	}
  }
  return $array;
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 */
function covidien_theme_preprocess_person_node_form(&$vars) {
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  drupal_add_js(drupal_get_path('module', 'covidien_users') .'/js/covidien_users.js');
  drupal_add_css(drupal_get_path('module', 'covidien_devices') .'/css/tabs.css');
  drupal_add_js(drupal_get_path('module', 'covidien_ui') .'/js/covidien_autocomplete.js');
  $title = t("Edit User Information");
  drupal_set_title($title);
  $vars['form']['field_first_name'][0]['value']['#title'] = "";
  $vars['form']['field_last_name'][0]['value']['#title'] = "";
  $vars['form']['field_covidien_employee']['value']['#title'] = "";
  $vars['form']['account']['roles']['#title'] = "";
	$submitted_roles_array = $vars['form']['account']['roles']['#value'];
	$default_role_submitted_value = '';
	if(!empty($vars['form']['default_role']['#value'])) {
		$default_role_submitted_value = $vars['form']['default_role']['#value'];
	}

  $vars['form']['field_business_unit']['nid']['nid']['#title'] = "";
  $vars['form']['field_user_language']['nid']['nid']['#title'] = "";
  $vars['emp_status'] = $vars['form']['field_covidien_employee']['value']['#value'];
  $vars['form']['field_business_unit']['nid']['nid']['#options'][''] = "";
	global $user;
	
	$productline = getAllProductlineRoles();
	$users_role = getUserProductlineRoles($vars['form']['#node']->uid);
	$login_user_role = getUserProductlineRoles($user->uid);
	$disabled_value = getDeniedPL($vars['form']['#node']->nid);
	$default_values = getUserDefaultRole($vars['form']['#node']->nid);
	$privilege_values = getUserPrivilegeValues($vars['form']['#node']->nid);
	$pl = array();
	$hidden_array = array_diff_key($users_role, $login_user_role);
	foreach($productline as $key=>$val) {
		$privilege_key = str_replace(' ','-',$key);
		if(array_key_exists($key, $hidden_array)) {
			$vars['form']['productline'][$key]['#value'] = $users_role[$key];
			$vars['form']['productline'][$privilege_key.'_privilege']['#value'] = $privilege_values[$key];
			$vars['form']['productline'][$key]['#attributes']['disabled'] = 'disabled';
			$vars['form']['productline'][$privilege_key.'_privilege']['#attributes'] = array('disabled'=>'disabled');
			$pl[$key] = drupal_render($vars['form']['productline'][$key]);
			$pl[$privilege_key.'_privilege'] = drupal_render($vars['form']['productline'][$privilege_key.'_privilege']);
		} else if(array_key_exists($key, $login_user_role)){
				$options = $vars['form']['productline'][$key]['#options'];
				$default_selected = 0;
				if(!empty($submitted_roles_array)) {
					foreach($submitted_roles_array as $k) {
						if(array_key_exists($k,$options)) {
							if(empty($vars['form']['#post'])) {
								$vars['form']['productline'][$privilege_key.'_privilege']['#value'] = $privilege_values[$key];
							}						
							$vars['form']['productline'][$key]['#value'] = $k;
							if($default_role_submitted_value == $k) { $default_selected = 1; $default_values['plvalue'] = $key;}
						}
					}
				}
			$pl[$key] = drupal_render($vars['form']['productline'][$key]);
			$pl[$privilege_key.'_privilege'] = drupal_render($vars['form']['productline'][$privilege_key.'_privilege']);
			if($default_selected == 1) {$pl['selected'][$key]= 1;}
			else {$pl['selected'][$key] = 0;}
		}
	}
  //Blank option at first
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
  $vars['form']['field_user_language']['nid']['nid']['#options'][''] = "";
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
		$unknown = db_result(db_query('select nid from {node} where title="%s" and type="party"','Unknown'));
		
  $vars['form']['buttons']['submit']['#attributes'] = array('onclick'=>'$("#edit-company-account-number").attr("disabled","disabled");','class'=>'form_submit_class');  
  $vars['form']['buttons']['unblock']['#attributes'] = array('onclick'=>'$("#edit-company-account-number").attr("disabled","disabled");');
  $vars['form']['field_device_avail_country']['nid']['nid']['#title'] = "";
	$vars['form']['field_device_avail_country']['nid']['nid']['#options'][''] = "";  
  // RFC
  /*
  $vars['form']['buttons']['submit']['#attributes'] = array('onclick'=>'if(!confirm("Do you want to save the changes you just made to this page?")){return false;}');
  */
  $user_status = $vars['form']['account']['status']['#value'];
  if($user_status == "1") {
	$vars['form']['buttons']['unblock']['#attributes'] = array('disabled'=>'disabled','class'=>'non_active_blue');
  }
  $vars['form']['account']['mail']['#type'] = "hidden";
  $vars['form']['account']['name']['#description'] = "";
  $vars['form']['account']['name']['#title'] = "";
  $vars['form']['account']['name']['#default_value'] = "Email address";
  $vars['email_name'] = $vars['form']['account']['name']['#value'];
  if(!empty($vars['form']['account']['name']['#post'])) {
    $vars['form']['account']['name']['#value'] = $vars['form']['account']['name']['#post']['mail'];
  }
  $vars['form']['account']['mail']['#value'] = $vars['form']['account']['name']['#value'];	
  $vars['form']['account']['mail']['#title'] = "";
  $vars['form']['account']['pass']['#size'] = "38";
  $vars['form']['account']['name']['#size'] = "38";
  $vars['form']['account']['mail']['#description'] = "";
  $vars['form']['account']['pass']['#type'] = "password";
  $vars['form']['account']['pass']['#description'] = "";
  $vars['form']['buttons']['delete']['#value'] = "Delete this User";
  $vars['form']['buttons']['submit']['#value'] = "Save Changes";
  $vars['mail'] = drupal_render($vars['form']['account']['mail']);
  $vars['name'] = drupal_render($vars['form']['account']['name']);
  $vars['pass'] = drupal_render($vars['form']['account']['pass']);
  $vars['roles'] = drupal_render($vars['form']['account']['roles']);
  $vars['status'] = drupal_render($vars['form']['changed']);
  $vars['first_name'] = drupal_render($vars['form']['field_first_name']);
  $vars['last_name'] = drupal_render($vars['form']['field_last_name']);
  $vars['language'] = drupal_render($vars['form']['field_user_language']);
  $vars['business_unit'] = drupal_render($vars['form']['field_business_unit']);
  $vars['covidien_user'] = drupal_render($vars['form']['field_covidien_employee']);
  $vars['delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['cancel'] = drupal_render($vars['form']['account']['cancel']);
  $vars['submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['unblock'] = drupal_render($vars['form']['buttons']['unblock']);
  $vars['form_token'] = drupal_render($vars['form']['form_token']);
  $vars['form_build_id'] = drupal_render($vars['form']['form_build_id']);
  $vars['form_id'] = drupal_render($vars['form']['form_id']);
  $vars['destination'] = drupal_render($vars['form']['account']['destination']);
  $vars['timezone'] = drupal_render($vars['form']['account']['timezone']);
  $vars['other_company'] = drupal_render($vars['form']['customer_name']);
  $vars['company_account_number'] = drupal_render($vars['form']['account_number']);
  $vars['country'] = drupal_render($vars['form']['field_device_avail_country']);
	if(empty($vars['form']['#post'])) {
	 $vars['form']['default_role']['#value'] = $default_values['rid'];
	}
	$vars['default_role'] = drupal_render($vars['form']['default_role']);
	$vars['device_type_array'] = drupal_render($vars['form']['device_type_array']);
	$vars['role_access_array'] = drupal_render($vars['form']['role_access_array']);
	$vars['role_name_array'] = drupal_render($vars['form']['role_name_array']);
	$vars['selected_device_array'] = $vars['form']['device_type_array']['#value'];
	$vars['selected_access_array'] = $vars['form']['role_access_array']['#value'];
	$vars['selected_role_array'] = $vars['form']['role_name_array']['#value'];

  $vars['render'] = drupal_render($vars['form']);
	$vars['productline'] = $productline;
	$vars['default_values'] = $default_values;
	$vars['hidden_array'] = $hidden_array;
	$vars['disabled_value'] = implode(",",$disabled_value);
	$vars['users_access_array_val'] = implode(",",$users_role);
  $vars['pl'] = $pl;
	$vars['userid'] = $vars['form']['#uid'];
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 */
function covidien_theme_preprocess_user_settings_node_form(&$vars) {
  global $user;
  $vars['form']['field_user_language']['nid']['nid']['#title'] = "";
  $vars['form']['field_user_language']['nid']['nid']['#value'] = getUserLanguage(arg(1));
  $vars['form']['field_email_notifications']['nid']['nid']['#title'] = "";
  //Blank option at first
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
  $vars['form']['field_user_language']['nid']['nid']['#options'][''] = "";
  $vars['form']['field_user_language']['nid']['nid']['#options'] = array_reverse($vars['form']['field_user_language']['nid']['nid']['#options'],true);
  $title = t("User Settings");
  drupal_set_title($title);
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  $vars['notifications'] = drupal_render($vars['form']['field_email_notifications']);
  $vars['form']['buttons']['submit']['#value'] = "Save changes";
  $vars['language'] = drupal_render($vars['form']['field_user_language']);
  $vars['old_pass'] = drupal_render($vars['form']['old_password']);
  $vars['new_pass'] = drupal_render($vars['form']['new_password']);
  $vars['con_pass'] = drupal_render($vars['form']['confirm_password']);
  $vars['delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['cancel'] = drupal_render($vars['form']['account']['cancel']);
  $vars['submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['render'] = drupal_render($vars['form']);
  $vars['user_expired'] = userExpired($user->name);
}
/**
 * Helper function
 * Used in covidien_theme_preprocess_user_settings_node_form
 */
function getUserLanguage($nid) {
	$uid = db_result(db_query("select uid from {node} where type='user_settings' and nid = '%s'",$nid));
	$lang = db_result(db_query("select field_user_language_nid from {content_field_user_language} as T1 join node as T2 on T1.nid = T2.nid where T2.type='person' and T2.uid = '%s'",$uid));
	return $lang;
}
/**
 * Implements hook_preprocess_templatename() to render the fileds for Device Config.
 */
function covidien_theme_preprocess_device_type_config_node_form(&$vars) {
  if(arg(2)=='edit'){
    drupal_set_title(t('Edit Configuration'));
  }else{
    drupal_set_title(t('Add a New Configuration'));
  }
	$vars['form']['field_effective_date'][0]['value']['date']['#maxlength'] = "10";
	$vars['form']['field_device_end_of_life'][0]['value']['date']['#maxlength'] = "10";
  $vars['config_title'] = drupal_render($vars['form']['title']);
  $vars['device_type'] = drupal_render($vars['form']['field_device_type']);
  $vars['field_device_config_version'] = drupal_render($vars['form']['field_device_config_version']);
  $vars['field_effective_date'] = drupal_render($vars['form']['field_effective_date']);
  $vars['field_device_end_of_life'] = drupal_render($vars['form']['field_device_end_of_life']);  
  $vars['hidden_config_hw_list_id'] = 'device_config_hw_listhidden';
  //If validation fails build the hidden fields
  if(!empty($vars['form']['#post'])){
    $hidden_hw = '';
    $hidden_hw_status='';
    if(count($vars['form']['#post']['hidden_viewfield_config_hw_sw_1']['nid']['nid'])>0){
      foreach($vars['form']['#post']['hidden_viewfield_config_hw_sw_1']['nid']['nid'] as $hw_nid){
	    $hidden_hw .= '<input type="hidden" name="hidden_viewfield_config_hw_sw_1[nid][nid]['.$hw_nid.']" ';
	    $hidden_hw .= 'original_name="viewfield_config_hw_sw_1[nid][nid]['.$hw_nid.']" ';
	    $hidden_hw .= 'original_id="edit-viewfield-config_hw_sw_1-nid-nid-'.$hw_nid.'" ';
	    $hidden_hw .= 'id="hidden_edit-viewfield-config_hw_sw_1-nid-nid-'.$hw_nid.'" ';
	    $hidden_hw .= 'value="'.$hw_nid.'" class="form-checkbox"> ';
	  }
    }
    if(count($vars['form']['#post']['hidden_viewfield_config_hw_sw_status_1']['nid']['nid'])>0){
      foreach($vars['form']['#post']['hidden_viewfield_config_hw_sw_status_1']['nid']['nid'] as $hw_nid=>$hw_status){
	    $hidden_hw_status .= '<input type="hidden" name="hidden_viewfield_config_hw_sw_status_1[nid][nid]['.$hw_nid.']" ';
	    $hidden_hw_status .= 'original_name="viewfield_config_hw_sw_status_1[nid][nid]['.$hw_nid.']" ';
	    $hidden_hw_status .= 'original_id="viewfield_config_hw_sw_status_1_nid_nid_'.$hw_nid.'" ';
	    $hidden_hw_status .= 'id="hidden_viewfield_config_hw_sw_status_1_nid_nid_'.$hw_nid.'" ';
	    $hidden_hw_status .= 'value="'.$hw_status.'" class="form-checkbox">';	  
	  }
    }  
    $hidden_sw = '';
    $hidden_sw_status='';
    if(count($vars['form']['#post']['hidden_viewfield_config_hw_sw']['nid'])>0){
      foreach($vars['form']['#post']['hidden_viewfield_config_hw_sw']['nid'] as $hw_nid=>$swnid){
	    if(count($swnid))
	    foreach($swnid as $sw_nid){
	      $hidden_sw .= '<input type="hidden" ';
	      $hidden_sw .= 'name="hidden_viewfield_config_hw_sw[nid]['.$hw_nid.']['.$sw_nid.']" ';
	      $hidden_sw .= 'original_name="viewfield_config_hw_sw[nid]['.$hw_nid.']['.$sw_nid.']" ';
	      $hidden_sw .= 'original_id="edit-viewfield-config_hw_sw-nid-'.$hw_nid.'-'.$sw_nid.'" ';
	      $hidden_sw .= 'id="hidden_edit-viewfield-config_hw_sw-nid-'.$hw_nid.'-'.$sw_nid.'" ';
	      $hidden_sw .= 'value="'.$sw_nid.'" class="form-checkbox"> ';
	    }
	  }
    }
    if(count($vars['form']['#post']['hidden_viewfield_config_hw_sw_status']['nid'])>0){
      foreach($vars['form']['#post']['hidden_viewfield_config_hw_sw_status']['nid'] as $hw_nid=>$swstatus){
	    if(count($swstatus))
	    foreach($swstatus as $sw_nid=>$sw_status){
	      $hidden_sw_status .= '<input type="hidden" ';
	      $hidden_sw_status .= 'name="hidden_viewfield_config_hw_sw_status[nid]['.$hw_nid.']['.$sw_nid.']" ';
	      $hidden_sw_status .= 'original_name="viewfield_config_hw_sw_status[nid]['.$hw_nid.']['.$sw_nid.']" ';
	      $hidden_sw_status .= 'original_id="viewfield_config_hw_sw_status_nid_'.$hw_nid.'_'.$sw_nid.'" ';
	      $hidden_sw_status .= 'id="hidden_viewfield_config_hw_sw_status_nid_'.$hw_nid.'_'.$sw_nid.'" ';
	      $hidden_sw_status .= 'value="'.$sw_status.'" class="form-checkbox">';
	    }
	  }
    }
    $output = $hidden_hw.$hidden_hw_status.$hidden_sw.$hidden_sw_status;
    //remove from hidden
    drupal_render($vars['form']['hidden']['config_hw_list']);
  }else{
    $output = drupal_render($vars['form']['hidden']['config_hw_list']);
  }
  $vars['hidden_config_hw_list'] = $output;
  $vars['config_hw_list'] = '<div id="device_config_hw_list_wraper"></div>';
  //Remove the form elements from UI
  $vars['form_delete'] = drupal_render($vars['form']['buttons']['delete']);
  $vars['form_cancel'] = drupal_render($vars['form']['buttons']['cancel']);
  $vars['form_submit'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['form_render'] = drupal_render($vars['form']);
}
/**
 * Hook implemented to customize filefield
 */
function covidien_theme_filefield_widget_item($element) {  
  // Put the upload button directly after the upload field.
  $element['upload']['#field_suffix'] = drupal_render($element['filefield_upload']);
  $element['upload']['#theme'] = 'filefield_widget_file';
  $element['preview']['#value'] = strip_tags($element['preview']['#value'],'<div>');
  $output = '';
  $output .= '<div class="filefield-element clear-block">';
  if ($element['fid']['#value'] != 0) {
    $output .= '<div class="widget-preview">';
    $output .= drupal_render($element['preview']);
    $output .= '</div>';
  }
  $output .= '<div class="widget-edit">';
  $output .=  drupal_render($element);
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
/**
 * Implements views data alter.
 */
function covidien_theme_views_view_field__individual_configuration__default__title_3($view, $field, $row){
  return covidien_device_config_doc('config_hw_document_list',$row->node_node_data_field_device_config_hardware_nid);
}
/**
 * Implements views data alter.
 */
function covidien_theme_views_view_field__individual_configuration__default__title_4($view, $field, $row){
  return covidien_device_config_doc('config_sw_document_list',$row->node_node_data_field_device_config_software_nid);
}
/**
 * Implements hook_preprocess_templatename() to render the fileds
 */
function covidien_theme_preprocess_views_view_table(&$vars) {
  $view = $vars['view'];
  if (($view->name == 'Users') || $view->name == "activity") {
    $options = $view->style_plugin->options;
	$handler = $view->style_plugin;
	$fields = &$view->field;
	$columns = $handler->sanitize_columns($options['columns'], $fields);
	$active = !empty($handler->active) ? $handler->active : '';
	$order = !empty($handler->order) ? $handler->order : 'asc';
	$query = tablesort_get_querystring();
	if (isset($view->exposed_raw_input)) {
	  $query_other = $view->exposed_raw_input;
	}
	foreach ($columns as $field => $column) {
	  $order_query = "";
	  $sort_query = "";
	  // render the header labels
	  if ($field == $column && empty($fields[$field]->options['exclude'])) {
	    $label = filter_xss_admin(!empty($fields[$field]) ? $fields[$field]->label() : ''); // THIS is the only line changed so far.
		if (($column == "variables") || ($column == "variables_1") || ($column == "title_5") || ($column == "title_6")) {
		   $initial = !empty($options['info'][$field]['default_sort_order']) ? $options['info'][$field]['default_sort_order'] : 'asc';
		   $query = "";
			if(!empty($query_other)) {
			  foreach($query_other as $k => $v) {
			    $query .= "&$k=$v";
			  }
			}
			if ($active == $field) {
			  $initial = ($order == 'asc') ? 'desc' : 'asc';
			}
			$title = t('sort by @s', array('@s' => $label));
			if ($active == $field) {
			  $label .= theme('tablesort_indicator', $initial);
			}
			$order_query = "order=".$field;
			$sort_query = "&sort=".$initial."&";
			$query = $order_query.$sort_query.$query;
			$link_options = array(
			  'html' => TRUE,
			  'attributes' => array('title' => $title),
			  'query' => $query,
			);
			$getq = filter_xss($_GET['q']);
			$vars['header'][$field] = l($label, $getq, $link_options);
		  }			
		  // Add a header label wrapper if one was selected.
		  if ($vars['header'][$field]) {
			  $vars['header'][$field] = $vars['header'][$field];
		  }
		}
	}
  }else if (($view->name == 'Hardwarelist')||($view->name == 'softwarelist')||($view->name == 'documentlist')) {
    template_custom_views_view_table($vars);
  }
}
/**
 * Implements hook_preprocess_templatename() to render the Person Training records fileds
 * @todo : translation update
 */
function covidien_theme_preprocess_person_training_record_node_form(&$vars) {
  global $user;
  drupal_add_js(drupal_get_path('theme', 'covidien_theme') .'/js/covidien.js');
  drupal_add_js(drupal_get_path('module', 'covidien_users') .'/js/covidien_users.js');
  $title = ($vars['form']['nid']['#value'] == "")?t("Add Training Record"):t("Edit Training Record");
  $button_title = ($vars['form']['nid']['#value'] == "")?t("Add Record"):t("Save Changes");
  drupal_set_title($title);  
  $vars['form']['buttons']['submit']['#value']=$button_title;
  $id = trim(arg(3));
  $result = node_load($id);
  $vars['user_id'] = $result->title;
	$vars['form']['title']['#value'] = "Training Record";
  $vars['form']['field_device_type']['nid']['nid']['#title'] = "";
  $vars['form']['field_training_completion_date'][0]['value']['#title'] = "";
  $vars['form']['field_training_completion_date'][0]['value']['date']['#maxlength'] = "10";
  $vars['form']['users_product_line']['#options'] = array_reverse($vars['form']['users_product_line']['#options'],true);
  $vars['form']['users_product_line']['#options'][''] = ''; 
  $vars['form']['users_product_line']['#options'] = array_reverse($vars['form']['users_product_line']['#options'],true);

  $vars['form']['field_active_flag']['value']['#title'] = "";
	$vars['form']['field_training_completion_date'][0]['value']['date']['#description']='';
  $vars['form']['field_trainer_id']['nid']['nid']['#title'] = "";
  $vars['form']['field_trainee_id']['nid']['nid']['#title'] = "";
  $vars['form']['users_product_line']['#attributes'] = array('onchange'=>'getDeviceTypeList(this)');
  $vars['form']['device_type_list']['#attributes'] = array('onchange'=>'getTrainersList(this)');
	if($vars['form']['field_device_type']['nid']['nid']['#value']) {
		$plnid = node_load($vars['form']['field_device_type']['nid']['nid']['#value']);
		$vars['form']['device_type_list']['#options'] = PLbasedDeviceType($plnid->field_device_product_line[0]['nid']);
		$vars['form']['device_type_list']['#value'] = $vars['form']['field_device_type']['nid']['nid']['#value'];
	}
	if($vars['form']['field_trainer_id']['nid']['nid']['#value']){
		$vars['form']['trainer_list']['#options'] = DeviceTypebasedUsers($vars['form']['field_device_type']['nid']['nid']['#value']);
		$vars['form']['trainer_list']['#value'] = $vars['form']['field_trainer_id']['nid']['nid']['#value'];	
	}

  $vars['form']['field_active_flag']['value']['#options'][''] = "";
  
  if($vars['form']['nid']['#value'] != ""){
    $trainerid = $vars['form']['field_trainer_id']['nid']['nid']['#value'];
    $vars['form']['field_trainer_id']['nid']['nid']['#attributes'] = array("disabled"=>"disabled");
    $vars['form']['trainer_list']['#attributes'] = array("disabled"=>"disabled");
		$plvalue = node_load($vars['form']['field_device_type']['nid']['nid']['#value']);
		$vars['form']['users_product_line']['#value'] = $plvalue->field_device_product_line[0]['nid'];
		$vars['form']['users_product_line']['#attributes'] = array("disabled"=>"disabled");
    $trainerid_opt = array($trainerid=>$vars['form']['field_trainer_id']['nid']['nid']['#options'][$trainerid]);
    $vars['form']['field_trainer_id']['nid']['nid']['#options']=$trainerid_opt;
	
    $dtypeid = $vars['form']['field_device_type']['nid']['nid']['#value'];
    $vars['form']['field_device_type']['nid']['nid']['#attributes'] = array("disabled"=>"disabled");
    $vars['form']['device_type_list']['#attributes'] = array("disabled"=>"disabled");
    $dtypeid_opt = array($dtypeid=>$vars['form']['field_device_type']['nid']['nid']['#options'][$dtypeid]);
    $vars['form']['field_device_type']['nid']['nid']['#options']=$dtypeid_opt;
	
	$vars['form']['field_training_completion_date'][0]['value']['date']['#attributes'] = array("disabled"=>"disabled");
  }else{
    $vars['form']['field_trainer_id']['nid']['nid']['#options'][''] = "";
    //Blank option at first
    $vars['form']['field_device_type']['nid']['nid']['#options'] = array_reverse($vars['form']['field_device_type']['nid']['nid']['#options'],true);
    $vars['form']['field_device_type']['nid']['nid']['#options'][''] = "";
    $vars['form']['field_device_type']['nid']['nid']['#options'] = array_reverse($vars['form']['field_device_type']['nid']['nid']['#options'],true);
    //
//	$vars['form']['field_training_completion_date'][0]['value']['date']['#attributes'] = array("readonly"=>"readonly");
  }
  
  $vars['form']['field_trainee_id']['nid']['nid']['#options'][''] = "";
  $vars['form']['device_type_list']['#options'][''] = "";
  $vars['form']['trainer_list']['#options'][''] = "";
  $vars['form']['field_trainee_id']['nid']['nid']['#value'] = $id;

  $vars['username'] = $result->field_first_name[0]['value'].' '.$result->field_last_name[0]['value'];

  $vars['trainer'] = drupal_render($vars['form']['field_trainer_id']);
  $vars['active_flag'] = drupal_render($vars['form']['field_active_flag']);
  $vars['training_completion_date'] = drupal_render($vars['form']['field_training_completion_date']);
  $vars['device_type'] = drupal_render($vars['form']['field_device_type']);
	$vars['form']['buttons']['submit']['#attributes'] = array('onclick'=>'$("#trainer_list,#device_type_list").attr("disabled","disabled");'); 
  $vars['save'] = drupal_render($vars['form']['buttons']['submit']);
  $vars['delete'] = drupal_render($vars['form']['buttons']['delete']);
	$vars['user_pl'] = drupal_render($vars['form']['users_product_line']);
	$vars['trainer_list'] = drupal_render($vars['form']['trainer_list']);
	$vars['device_type_list'] = drupal_render($vars['form']['device_type_list']);
  $vars['render'] = drupal_render($vars['form']);
}
/**
 * Display a view as a table style.
 * version = "6.x-2.16"
 * location = views/theme/theme.inc
 * Customized to avoid plain sting process two times for anchor tag title attribute.
 */
function template_custom_views_view_table(&$vars) {
  $view     = $vars['view'];

  // We need the raw data for this grouping, which is passed in as $vars['rows'].
  // However, the template also needs to use for the rendered fields.  We
  // therefore swap the raw data out to a new variable and reset $vars['rows']
  // so that it can get rebuilt.
  // Store rows so that they may be used by further preprocess functions.
  $result   = $vars['result'] = $vars['rows'];
  $vars['rows'] = array();

  $options  = $view->style_plugin->options;
  $handler  = $view->style_plugin;

  $fields   = &$view->field;
  $columns  = $handler->sanitize_columns($options['columns'], $fields);

  $active   = !empty($handler->active) ? $handler->active : '';
  $order    = !empty($handler->order) ? $handler->order : 'asc';

  parse_str(tablesort_get_querystring(), $query);
  if (isset($view->exposed_raw_input)) {
    $query += $view->exposed_raw_input;
  }
  $query = empty($query) ? '' : '&' . http_build_query($query, '', '&');

  $header = array();

  // Fields must be rendered in order as of Views 2.3, so we will pre-render
  // everything.
  $renders = $handler->render_fields($result);

  foreach ($columns as $field => $column) {
    // render the header labels
    if ($field == $column && empty($fields[$field]->options['exclude'])) {
      $label = (!empty($fields[$field]) ? $fields[$field]->label() : '');
      if (empty($options['info'][$field]['sortable']) || !$fields[$field]->click_sortable()) {
        $vars['header'][$field] = $label;
      }
      else {
        // @todo -- make this a setting
        $initial = 'asc';

        if ($active == $field && $order == 'asc') {
          $initial = 'desc';
        }

        $title = t('sort by !s', array('!s' => $label));
        if ($active == $field) {
          $label .= theme('tablesort_indicator', $initial);
        }
        $link_options = array(
          'html' => true,
          'attributes' => array('title' => $title),
          'query' => 'order=' . urlencode($field) . '&sort=' . $initial . $query,
        );
        $vars['header'][$field] = l($label, $_GET['q'], $link_options);
      }
    }

    // Create a second variable so we can easily find what fields we have and what the
    // CSS classes should be.
    $vars['fields'][$field] = views_css_safe($field);
    if ($active == $field) {
      $vars['fields'][$field] .= ' active';
    }

    // Render each field into its appropriate column.
    foreach ($result as $num => $row) {
      if (!empty($fields[$field]) && empty($fields[$field]->options['exclude'])) {
        $field_output = $renders[$num][$field];

        if (!isset($vars['rows'][$num][$column])) {
          $vars['rows'][$num][$column] = '';
        }

        // Don't bother with separators and stuff if the field does not show up.
        if ($field_output === '') {
          continue;
        }

        // Place the field into the column, along with an optional separator.
        if ($vars['rows'][$num][$column] !== '') {
          if (!empty($options['info'][$column]['separator'])) {
            $vars['rows'][$num][$column] .= filter_xss_admin($options['info'][$column]['separator']);
          }
        }

        $vars['rows'][$num][$column] .= $field_output;
      }
    }
  }

  $count = 0;
  foreach ($vars['rows'] as $num => $row) {
    $vars['row_classes'][$num][] = ($count++ % 2 == 0) ? 'odd' : 'even';
  }

  $vars['row_classes'][0][] = 'views-row-first';
  $vars['row_classes'][count($vars['row_classes']) - 1][] = 'views-row-last';

  $vars['class'] = 'views-table';
  if (!empty($options['sticky'])) {
    drupal_add_js('misc/tableheader.js');
    $vars['class'] .= " sticky-enabled";
  }
  $vars['class'] .= ' cols-' . count($vars['header']);

  $vars['attributes'] = '';
  if (!empty($handler->options['summary'])) {
    $vars['attributes'] = drupal_attributes(array('summary' => $handler->options['summary']));
  }
}
function getTraineraccessforDevice($trainer,$device) {
	$result = db_result(db_query("select T5.title from {content_type_device_user_privileges} as T1 join {content_field_device_type} as T2 on T1.nid = T2.nid join {content_field_person_pk} as T3 on T1.nid = T3.nid join {content_type_section_access_option} as T4 on T1.field_user_section_access_nid = T4.nid join node as T5 on T4.field_access_option_nid = T5.nid where T3.field_person_pk_nid = '%s' and T2.field_device_type_nid = '%s'",$trainer,$device));
	return $result;
}
function convertDrupalTime($time,$format='m/d/Y h:i:s A',$zone = 'UTC') {
		// Get Drupal timezone info
		$drupal_time_zone =  date_default_timezone_name();
		// Convert given time to UTC 
		$date = new DateTime($time, new DateTimeZone($zone));
		// Convert time to Drupal timezone
		$date->setTimezone(new DateTimeZone($drupal_time_zone));
		$date2 = $date->format($format);
		return $date2;
}
