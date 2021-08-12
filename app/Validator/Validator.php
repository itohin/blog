<?php

declare(strict_types=1);

namespace App\Validator;

class Validator
{
    private array $fields;

    private array $errors = [];

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function validate($rules)
    {
        foreach ($rules as $field => $restrictions) {
            foreach ($restrictions as $restriction) {
                if (is_array($restriction)) {
                    foreach ($restriction as $key => $param) {
                        $this->validateRule($field, $key, $param);
                    }
                } else {
                    $this->validateRule($field, $restriction);
                }
            }
        }
        return $this;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    protected function validateRule(string $field, string $restriction, $param = null)
    {
        $method = 'validate' . ucfirst($restriction);
        if ($restriction !== 'required' && !array_key_exists($field, $this->fields)) {
            return;
        }
        if (is_null($param)) {
            $this->$method($field);
        } else {
            $this->$method($field, $param);
        }
    }

    protected function validateMin(string $field, int $min)
    {
        $field = $this->fields[$field];
        if (is_numeric($field)) {
            if ((int)$field < $min) {
                $this->errors[$field][] = 'Min value is ' . $min;
                return;
            }
        }
        if (is_array($field)) {
            if (count($field) < $min) {
                $this->errors[$field][] = 'Min length is ' . $min;
                return;
            }
        }
        if (strlen($field) < $min) {
            $this->errors[$field][] = 'Min length is ' . $min;
        }
    }

    protected function validateEmail(string $field)
    {
        if (filter_var($this->fields[$field], \FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[$field][] = 'This field must be a valid email';
        }
    }

    protected function validateRequired(string $field)
    {
        if (!array_key_exists($field, $this->fields)) {
            $this->errors[$field][] = 'This field is required';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}