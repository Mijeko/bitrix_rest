<?php

namespace Abm22\Tool\Traits;

use CAllUserTypeEntity;

trait UserFieldTrait
{
    public $arFields;

    public function __construct($component = null)
    {
        global $USER_FIELD_MANAGER;
        $this->arFields = $USER_FIELD_MANAGER->GetUserFields("USER");
        parent::__construct($component);
    }

    public function getUserFieldLabel(string $field_code)
    {
        $arField = $this->getFieldFromFM($field_code);

        $user_type_entity = CAllUserTypeEntity::GetByID($arField['ID']);
        return $user_type_entity['LIST_COLUMN_LABEL'][LANGUAGE_ID] ?: $field_code;
    }

    public function getFieldFromFM(string $field_code)
    {
        foreach ($this->arFields as $arField) {

            if (substr($field_code, 0, 3) != 'UF_') $field_code = 'UF_' . $field_code;

            if ($field_code == $arField['FIELD_NAME']) return $arField;
        }

        return false;
    }
}