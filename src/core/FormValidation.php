<?php
declare(strict_types=1);

namespace Src\Core;

abstract class FormValidation
{
    use CheckInputTrait;
    use CheckFileTrait;
    
    /**
     * @var const
     */
    private const REQUIRED = 'required';
    private const MIN_LENGTH = 'min';
    private const MAX_LENGTH = 'max';
    private const EMAIL = 'email';
    private const EQUALS = 'equals';
    private const UNIQUE = 'unique';
    private const EXACT = 'exact';
    private const EXISTS = 'exists';
    private const MAX_SIZE = 'size';
    private const EXTENSION = 'extension';
    private const REQUIRED_FILE = 'required_file';

    /**
     * @var array
     */
    private array $data;
    private array $errors = [];

    /**
     * @return array
     */
    protected abstract function validation(): array;
    
    protected abstract function fieldName(): array;

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateForm(array $data): bool
    {
        $this->data = $data;
        $this->setProperties();
        foreach ($this->validation() as $property => $conditions) {
            foreach ($conditions as $condition) {
                $value = $this->{$property};
                $array = explode(':', $condition);
                $condName = $array[0];
                $condValue = null;
                if (isset($array[1])) {
                    $condValue = $array[1];
                }

                if ($condName === self::REQUIRED && !$this->checkRequired($value)) {
                    $this->setErrors($property, $condName);
                }

                if ($condName === self::MIN_LENGTH && !$this->checkMinLength($value, $condValue)) {
                    $this->setErrors($property, $condName, $condValue);
                }

                if ($condName === self::MAX_LENGTH && !$this->checkMaxLength($value, $condValue)) {
                    $this->setErrors($property, $condName, $condValue);
                }

                if ($condName === self::EMAIL && !$this->checkEmail($value)) {
                    $this->setErrors($property, $condName);
                }

                if ($condName === self::EQUALS && !$this->checkEquals($value, $condValue)) {
                    $this->setErrors($property, $condName, $condValue);
                }

                if ($condName === self::UNIQUE && !$this->checkUnique($value, $condValue)) {
                    $this->setErrors($property, $condName);
                }

                if ($condName === self::EXACT && !$this->checkExact($value, $condValue)) {
                    $this->setErrors($property, $condName);
                }

                if ($condName === self::EXISTS && !$this->checkExists($value, $condValue)) {
                    $this->setErrors($property, $condName);
                }

                if ($condName === self::MAX_SIZE && !$this->checkMaxSize($value, $condValue)) {
                    $this->setErrors($property, $condName, $condValue);
                }

                if ($condName === self::EXTENSION && !$this->checkExtension($value, $condValue)) {
                    $this->setErrors($property, $condName, $condValue);
                }

                if ($condName === self::REQUIRED_FILE && !$this->checkRequiredFile($value)) {
                    $this->setErrors($property, $condName, $condValue);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @return void
     */
    private function setProperties(): void
    {
        foreach ($this->data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param string $property
     * @param string $condName
     * @param string $condValue
     * @return void
     */
    private function setErrors(string $property, string $condName, string $condValue = null): void
    {
        $this->errors[$this->fieldName()[$property]] = $this->createError($condName, $condValue);
    }

    /**
     * @param string $condName
     * @param string $condValue
     * @return string
     */
    private function createError(string $condName, string $condValue = null): string
    {
        return $this->errorsMessages($condValue)[$condName];
    }

    /**
     * @param string $condValue
     * @return array
     */
    private function errorsMessages(string $condValue = null): array
    {
        return [
            self::REQUIRED => 'Este campo é obrigatorio',
            self::MIN_LENGTH => 'O mínimo de caracteres necessários para este campo são '.$condValue,
            self::MAX_LENGTH => 'O maximo de caracteres necessários para este campo são '.$condValue,
            self::EMAIL => 'Este email não é valido',
            self::EQUALS => 'Este campo não é parecido com '.$condValue,
            self::UNIQUE => 'Este valor ja foir registrado no banco de dados',
            self::EXACT => 'Campo invalido',
            self::EXISTS => 'Erro ao inserir valores',
            self::MAX_SIZE  => 'O tamanho maximo do arquivo é '.$condValue.' bytes',
            self::EXTENSION => 'Esta não é uma extenção valida',
            self::REQUIRED_FILE => 'Este arquivo é necessario'
        ];
    }
}