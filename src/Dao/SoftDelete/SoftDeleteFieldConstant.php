<?php

namespace Codeages\Biz\Framework\Dao\SoftDelete;

class SoftDeleteFieldConstant
{
    const FIELD_TYPE_BOOL = 'bool';

    const FIELD_TYPE_TIMESTAMP = 'timestamp';

    const FIELD_TYPE_TIMESTAMP_MS = 'timestamp_ms';

    const FIELD_TYPE_INT = 'int';

    const FIELD_TYPE_STRING = 'string';

    public static function getFieldTrueValue($fieldType)
    {
        switch ($fieldType) {
            case self::FIELD_TYPE_BOOL:
                return true;
            case self::FIELD_TYPE_INT:
                return 1;
            case self::FIELD_TYPE_TIMESTAMP:
                return time();
            case self::FIELD_TYPE_STRING:
                return '1';
            case self::FIELD_TYPE_TIMESTAMP_MS:
                return intval(microtime(true) * 1000);
        }

        return null;
    }

    public static function getFieldFalseValue($fieldType)
    {
        switch ($fieldType) {
            case self::FIELD_TYPE_BOOL:
                return false;
            case self::FIELD_TYPE_INT:
                return 0;
            case self::FIELD_TYPE_TIMESTAMP:
            case self::FIELD_TYPE_TIMESTAMP_MS:
                return null;
            case self::FIELD_TYPE_STRING:
                return '0';
        }
        return null;
    }

    public static function getFieldIsTrueSql($field, $fieldType)
    {
        $sql = '';
        switch ($fieldType) {
            case self::FIELD_TYPE_BOOL:
            case self::FIELD_TYPE_INT:
                $sql = $field . ' = ' . 1;
                break;
            case self::FIELD_TYPE_TIMESTAMP:
            case self::FIELD_TYPE_TIMESTAMP_MS:
                $sql = $field . ' is not null ';
                break;
            case self::FIELD_TYPE_STRING:
                $sql = $field . " != '' ";
                break;
        }
        return $sql;
    }

    public static function getFieldIsFalseSql($field, $fieldType)
    {
        $sql = '';
        switch ($fieldType) {
            case self::FIELD_TYPE_BOOL:
            case self::FIELD_TYPE_INT:
                $sql = $field . ' != ' . 1;
                break;
            case self::FIELD_TYPE_TIMESTAMP:
            case self::FIELD_TYPE_TIMESTAMP_MS:
                $sql = $field . ' is null ';
                break;
            case self::FIELD_TYPE_STRING:
                $sql = $field . " = '' ";
                break;
        }
        return $sql;
    }
}