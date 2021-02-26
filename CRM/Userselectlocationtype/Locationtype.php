<?php

class CRM_Userselectlocationtype_Locationtype extends CRM_Core_DAO {


  static $_fields = null;

  /**
   * returns all the column names of this table
   *
   * @access public
   * @return array
   */
  static function &fields() {
    if (!(self::$_fields)) {
      self::$_fields = [
          'address_location_type_id' => [
          'name' => 'address_location_type_id',
          'html_type' => 'Select',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Address Location Type'),
          'description' => ts('Which Location does this address belong to.'),
          'where' => 'civicrm_address.location_type_id',
          'table_name' => 'civicrm_address',
          'entity' => 'Address',
          'bao' => 'CRM_Core_BAO_Address',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'import' => TRUE,
          'pseudoconstant' => [
            'table' => 'civicrm_location_type',
            'keyColumn' => 'id',
            'labelColumn' => 'display_name',
          ],
          'add' => '2.0',
        ],
        'email_location_type_id' => [
          'name' => 'email_location_type_id',
          'html_type' => 'Select',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Email Location Type'),
          'description' => ts('Which Location does this email address belong to.'),
          'table_name' => 'civicrm_email',
          'where' => 'civicrm_email.location_type_id',
          'entity' => 'Email',
          'bao' => 'CRM_Core_BAO_Email',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'import' => TRUE,
          'pseudoconstant' => [
            'table' => 'civicrm_location_type',
            'keyColumn' => 'id',
            'labelColumn' => 'display_name',
          ],
          'add' => '2.0',
        ],
        'phone_location_type_id' => [
          'name' => 'phone_location_type_id',
          'html_type' => 'Select',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Phone Location Type'),
          'description' => ts('Which Location does this Phone belong to.'),
          'table_name' => 'civicrm_phone',
          'where' => 'civicrm_phone.location_type_id',
          'entity' => 'Phone',
          'bao' => 'CRM_Core_BAO_Phone',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'import' => TRUE,
          'pseudoconstant' => [
            'table' => 'civicrm_location_type',
            'keyColumn' => 'id',
            'labelColumn' => 'display_name',
          ],
          'add' => '2.0',
        ],
      ];
    }
    return self::$_fields;
  }

  public function &getFields() {
    $fields = self::fields();
    return $fields;
  }
}
