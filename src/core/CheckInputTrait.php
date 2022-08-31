<?php
declare(strict_types=1);

namespace Src\Core;

trait CheckInputTrait
{
    /**
     * @param string $value
     * @return bool
     */
    public function checkRequired(string $value): bool
    {
        if (isset($value) && $value !== '') {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkMinLength(string $value, string $condValue): bool
    {
        if (strlen($value) >= (int)$condValue) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkMaxLength(string $value, string $condValue): bool
    {
        if (strlen($value) <= (int)$condValue) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function checkEmail(string $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkEquals(string $value, string $condValue): bool
    {
        if (property_exists($this, $condValue)) {
            $property = $this->{$condValue};
            if ($value === $property) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkUnique(string $value, string $condValue): bool
    {
        //unique:email-users
        $array = explode('-', $condValue);
        $column = $array[0];
        $table = $array[1];
        $query = new Query();
        $query->tableName = $table;
        $query->select([$column])
            ->where([$column => $value]);
        if ($query->getRowCount() === 0) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkExact(string $value, string $condValue): bool
    {
        $array = explode('|', $condValue);
        if (in_array($value, $array)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value
     * @param string $condValue
     * @return bool
     */
    public function checkExists(string $value, string $condValue): bool
    {
        //exists:unique_name-communities
        $array = explode('-', $condValue);
        $query = new Query();
        $query->tableName = $array[1];
        $count = $query->select(['*'])
            ->where([$array[0] => $value])
            ->getRowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }
}