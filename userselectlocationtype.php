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
  if ($formName == 'CRM_Contribute_Form_Contribution_Main' || $formName == 'CRM_Event_Form_Registration_Register' || $formName == 'CRM_Profile_Form_Edit') {

    $locationTypeOptions = [
      // ID 1
      'Home' => 'Home',
      // ID 2
      'Work' => 'Work',
      // ID 4
      'Other' => 'Other',
    ];

    // If there is an Address Location Type field format it approprately
    if (isset($form->_fields['address_location_type_id'])) {
      $addressLocType = $form->getElement('address_location_type_id');
      $form->removeElement('address_location_type_id');
      $form->add('select', 'address_location_type_id', ts('Address Location Type'), $locationTypeOptions, FALSE, ['placeholder' => TRUE]);
    }

    // If there is an Email Location Type field format it approprately
    if (isset($form->_fields['email_location_type_id'])) {
      $addressLocType = $form->getElement('email_location_type_id');
      $form->removeElement('email_location_type_id');
      $form->add('select', 'email_location_type_id', ts('Email Location Type'), $locationTypeOptions, FALSE, ['placeholder' => TRUE]);

    }

    // If there is an Phone Location Type field format it approprately
    if (isset($form->_fields['phone_location_type_id'])) {
      $addressLocType = $form->getElement('phone_location_type_id');
      $form->removeElement('phone_location_type_id');
      $form->add('select', 'phone_location_type_id', ts('Phone Location Type'), $locationTypeOptions, FALSE, ['placeholder' => TRUE]);
    }
  }
}

/**
 * Implements hook_civicrm_pre().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_post/
 */
function userselectlocationtype_civicrm_pre($op, $objectName, $objectId, &$objectRef) {

  if ($objectName == 'Profile') {
    if ($op == 'create' || $op == 'edit' || $op == 'update') {

      // AGH #25018 Custom State/Country Hack because core Country/State fields are not accessible at the moment.

      // IF the user has selected a country field
      if (isset($objectRef['custom_881'])) {

        // Save Custom Country as Country
        $objectRef['country_id-Primary'] = $objectRef['custom_881'];

        // If the user has selected a custom state field
        if (isset($objectRef['custom_880'])) {

          // check that the state selected is a valid state option for the selected country
          try {
            $validState = civicrm_api3('StateProvince', 'get', [
              'country_id' => $objectRef['custom_881'],
              'id' => $objectRef['custom_880'],
            ]);
          }
          catch (CiviCRM_API3_Exception $e) {
            $error = $e->getMessage();
            CRM_Core_Error::debug_log_message(ts('API Error: %1', [1 => $error, 'domain' => 'com.aghstrategies.userselectlocationtype']));
          }

          // Save the custom state as the state
          if ($validState['count'] == 1 && isset($validState['id'])) {
            $objectRef['state_province_id-Primary'] = $validState['id'];
          }
        }
      }

      $locationTypeOptions = [
        'Home' => 1,
        'Work' => 2,
        'Other' => 4,
      ];

      // When a profile with an Address Location Type field is submitted, update the location type of the primary address
      if (isset($locationTypeOptions[$objectRef['address_location_type_id']]) && $locationTypeOptions[$objectRef['address_location_type_id']] > 0) {
        $addressFields = [
          'street_address',
          'supplemental_address_1',
          'supplemental_address_2',
          'supplemental_address_3',
          'city',
          'county_id',
          'state_province_id',
          'postal_code',
          'country_id',
        ];

        foreach ($addressFields as $key => $fieldName) {
          if (isset($objectRef["$fieldName-Primary"])) {
            $objectRef["$fieldName-{$locationTypeOptions[$objectRef['address_location_type_id']]}"] = $objectRef["$fieldName-Primary"];
            unset($objectRef["$fieldName-Primary"]);
          }
        }
      }

      if (isset($locationTypeOptions[$objectRef['email_location_type_id']]) && $locationTypeOptions[$objectRef['email_location_type_id']] > 0 && isset($objectRef['email-Primary'])) {
        $objectRef["email-{$locationTypeOptions[$objectRef['email_location_type_id']]}"] = $objectRef['email-Primary'];
        unset($objectRef['email-Primary']);
      }

      if (isset($locationTypeOptions[$objectRef['phone_location_type_id']]) && $locationTypeOptions[$objectRef['phone_location_type_id']] > 0 && isset($objectRef['phone-Primary-1'])) {
        $objectRef["phone-{$locationTypeOptions[$objectRef['phone_location_type_id']]}-1"] = $objectRef['phone-Primary-1'];
        unset($objectRef['phone-Primary-1']);
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
