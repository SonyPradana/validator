<?php

declare(strict_types=1);

namespace Validator;

use Closure;
use Exception;
use Validator\Rule\Valid;
use Validator\Rule\ValidPool;

/**
 * @internal
 */
final class Validator
{
    private Rule $Rule;

    /** @var string[] */
    private $fields      = [];
    /** @var Valid[] */
    private $validations = [];

    /**
     * Create validation and filter.
     *
     * @param string[] $fileds Field array to validate
     */
    public function __construct($fileds = [])
    {
        $this->Rule   = new Rule();
        $this->fields = $fileds;
    }

    /**
     * Add new valid rule.
     *
     * @param string $name Field name
     *
     * @return Valid New rule Validation
     */
    public function __get($name): Valid
    {
        return $this->field($name);
    }

    /**
     * Add new valid rule.
     *
     * @param string $name Field name
     *
     * @return Valid New rule Validation
     */
    public function __invoke($field): Valid
    {
        return $this->field($field);
    }

    /**
     * Add new valid rule.
     *
     * @param string $name Field name
     *
     * @return Valid New rule Validation
     */
    public function field(string $field): Valid
    {
        return $this->validations[$field] = new Valid();
    }

    /**
     * Set fields or input for validation.
     *
     * @param string[] $fileds Field array to validate
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Process the validation errors and return an array of errors with field names as keys.
     */
    public function get_error(): array
    {
        return $this->Rule->get_errors_array();
    }

    /**
     * Inline validation field.
     *
     * @param \Closure|null $rule_validation Closure with param as ValidPool,
     *                                       if null return validate this currect validation
     */
    public function is_valid(?Closure $rule_validation = null): bool
    {
        if ($rule_validation == null) {
            return $this->Rule->is_valid($this->fields, $this->validations) !== true ? false : true;
        }

        $rules = [];
        $pool  = new ValidPool();

        $return_closure = call_user_func_array($rule_validation, [$pool]);
        $get_pool       = $return_closure instanceof ValidPool
            ? $return_closure->get_pool()
            : $pool->get_pool()
        ;

        foreach ($get_pool as $field => $rule) {
            $rules[$field] = $rule->get_validation();
        }

        $this->Rule->validation_rules($rules);
        if ($this->Rule->run($this->fields) === false) {
            return false;
        }

        return true;
    }

    /**
     * Execute closuer when validation is true,
     * and return else statment.
     *
     * @param Closure $condition Excute closure
     */
    public function if_valid(Closure $condition): ValidationCondition
    {
        $val = $this->Rule->validate($this->fields, $this->validations);

        if ($val === true) {
            call_user_func($condition);

            return new ValidationCondition([]);
        }

        return new ValidationCondition($val);
    }

    /**
     * Run validation, and throw error when false.
     *
     * @param \Exception|null $exception Default throw exception
     *
     * @throws Exception
     *
     * @return bool Return true if validation valid
     */
    public function validOrException(Exception $exception = null)
    {
        if ($this->Rule->validate($this->fields, $this->validations) === false) {
            throw $exception ?? new Exception('vaildate if fallen');
        }

        return true;
    }

    /**
     * Run validation, and get error when false.
     *
     * @return bool|array Return true if validation valid
     */
    public function validOrError(Exception $exception = null)
    {
        return $this->Rule->validate($this->fields, $this->validations);
    }
}
