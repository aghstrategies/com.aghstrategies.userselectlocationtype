<?php

require_once 'userselectlocationtype.civix.php';
// phpcs:disable
use CRM_Userselectlocationtype_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_queryObjects().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_queryObjects/
 */
function userselectlocationtype_civicrm_queryObjects(&$queryObjects, $type) {
  // Adds Address Location Type to Profile Field Options (Under Contact)
  if ($type == 'Contact') {
    $queryObjects[] = new CRM_Userselectlocationtype_Locationtype();
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function userselectlocationtype_civicrm_buildForm($formName, &$form) {

  // If there is an Address Location Type field format it approprately
  if (isset($form->_fields['address_location_type_id'])) {
    if ($formName == 'CRM_Contribute_Form_Contribution_Main' || $formName == 'CRM_Event_Form_Registration_Register' || $formName == 'CRM_Profile_Form_Edit') {
      $addressLocType = $form->getElement('address_location_type_id');
      $form->removeElement('address_location_type_id');
      $form->addEntityRef('address_location_type_id', ts('Address Location Type'), [
        'entity' => 'LocationType',
        'select' => ['minimumInputLength' => 0],
      ]);
    }
  }
}

/**
 * Implements hook_civicrm_post().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_post/
 */
function userselectlocationtype_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  // When a profile with an Address Location Type field is submitted, update the location type of the primary address
  if ($objectName == 'Profile') {
    if ($op == 'create' || $op == 'edit' || $op == 'update') {
      if (isset($objectRef['address_location_type_id']) && $objectRef['address_location_type_id'] > 0) {
        try {
          $address = civicrm_api3('Address', 'get', [
            'is_primary' => 1,
            'contact_id' => $objectId,
            'options' => ['limit' => 1],
            'api.Address.create' => ['id' => "\$value.id", 'location_type_id' => $objectRef['address_location_type_id']],
          ]);
        }
        catch (CiviCRM_API3_Exception $e) {
          $error = $e->getMessage();
          CRM_Core_Error::debug_log_message(E::ts('API Error %1', array(
            'domain' => 'com.aghstrategies.userselectlocationtype',
            1 => $error,
          )));
        }
      }
    }
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
