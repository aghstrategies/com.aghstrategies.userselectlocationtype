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
      self::$_fields = ['address_location_type_id' => [
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
      ]];
    }
    return self::$_fields;
  }

  public function &getFields() {
    $fields = self::fields();
    return $fields;
  }
}
