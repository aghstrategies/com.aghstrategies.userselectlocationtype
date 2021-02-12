<?php

require_once 'userselectlocationtype.civix.php';
// phpcs:disable
use CRM_Userselectlocationtype_ExtensionUtil as E;
// phpcs:enable


function userselectlocationtype_civicrm_buildForm($formName, &$form) {

  // TODO Add Address Location Type Field to profile field options
  if ($formName == 'CRM_UF_Form_Field') {
    $fields = $form->getVar('_fields');
    $fields['address_location_type'] = CRM_Core_DAO_Address::fields()['location_type_id'];
    $fields['address_location_type']['name'] = 'address_location_type';
    $form->setVar('_fields', $fields);

    $selectFields = $form->getVar('_selectFields');
    $selectFields['address_location_type'] = "Address Location Type";
    $form->setVar('_selectFields', $selectFields);
    $form->_elements[$form->_elementIndex['field_name']]->_options[1]['Contact']['address_location_type'] = "Address Location Type";
    $form->_elements[$form->_elementIndex['field_name']]->_options[2]['Contact']['address_location_type'] = '';
    $form->_mapperFields['Contact']['address_location_type'] = "Address Location Type";

    // TODO add to js here somehow
    print_r($form->_elements[$form->_elementIndex['field_name']]->_js); die();
    // $json = json_decode("{" . $form->_elements[$form->_elementIndex['field_name']]->_js . "}", TRUE, TRUE);
    // var_dump($json); die();
  }
}
/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function userselectlocationtype_civicrm_config(&$config) {
  _userselectlocationtype_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function userselectlocationtype_civicrm_xmlMenu(&$files) {
  _userselectlocationtype_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function userselectlocationtype_civicrm_install() {
  _userselectlocationtype_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function userselectlocationtype_civicrm_postInstall() {
  _userselectlocationtype_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function userselectlocationtype_civicrm_uninstall() {
  _userselectlocationtype_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function userselectlocationtype_civicrm_enable() {
  _userselectlocationtype_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function userselectlocationtype_civicrm_disable() {
  _userselectlocationtype_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function userselectlocationtype_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _userselectlocationtype_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function userselectlocationtype_civicrm_managed(&$entities) {
  _userselectlocationtype_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function userselectlocationtype_civicrm_caseTypes(&$caseTypes) {
  _userselectlocationtype_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function userselectlocationtype_civicrm_angularModules(&$angularModules) {
  _userselectlocationtype_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function userselectlocationtype_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _userselectlocationtype_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function userselectlocationtype_civicrm_entityTypes(&$entityTypes) {
  _userselectlocationtype_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function userselectlocationtype_civicrm_themes(&$themes) {
  _userselectlocationtype_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function userselectlocationtype_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function userselectlocationtype_civicrm_navigationMenu(&$menu) {
//  _userselectlocationtype_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _userselectlocationtype_civix_navigationMenu($menu);
//}
