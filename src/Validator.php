<?php

declare(strict_types=1);

namespace Validator;

use Closure;
use Exception;
use Validator\Messages\MessagePool;
use Validator\Rule\Filter;
use Validator\Rule\FilterPool;
use Validator\Rule\Valid;
use Validator\Rule\ValidPool;

/**
 * @internal
 *
 * @property Collection $errors
 * @property Collection $filters
 */
final class Validator
{
    private Rule $Rule;

    /** @var array<string, mixed> */
    private $fields = [];
    /** @var ValidPool Valid rule collection */
    private $valid_pool;
    /** @var FilterPool Filter rule collection */
    private $filter_pool;

    /** @var bool Check rule validate has run or not */
    private $has_run_validate = false;

    /**
     * Create validation and filter.
     *
     * @param array<string, mixed> $fileds Field array to validate
     */
    public function __construct($fileds = [])
    {
        $this->Rule        = new Rule();
        $this->fields($fileds);
        $this->valid_pool  = new ValidPool();
        $this->filter_pool = new FilterPool();
    }

    /**
     * Create validation and filter using static.
     *
     * @param array<string, mixed>                      $fileds        Field array to validate
     * @param callable(ValidPool=): (ValidPool|mixed)   $validate_pool Closure with param as ValidPool
     * @param callable(FilterPool=): (FilterPool|mixed) $filter_pool   Closure with param as ValidPool
     *
     * @return static
     */
    public static function make($fileds = [], $validate_pool = null, $filter_pool = null)
    {
        $validate = new static($fileds);
        if ($validate_pool !== null) {
            $validate->validation($validate_pool);
        }

        if ($filter_pool !== null) {
            $validate->filters($filter_pool);
        }

        return $validate;
    }

    /**
     * Set new feild rule.
     *
     * @param string $name  Field name
     * @param string $value Validation Rule
     *
     * @return void
     */
    public function __set($name, $value)
    {
        $this->field($name)->raw($value);
    }

    /**
     * Add new valid rule.
     *
     * @param string $name Field name
     *
     * @return Valid|Collection<string, mixed>|mixed New rule Validation
     */
    public function __get($name)
    {
        if ($name === 'errors') {
            return $this->errors();
        }

        if ($name === 'filters') {
            return new Collection($this->filter_out());
        }

        return $this->field($name);
    }

    /**
     * Add new valid rule.
     *
     * @param string $field Field name
     *
     * @return Valid New rule Validation
     */
    public function __invoke(string ...$field): Valid
    {
        return $this->field(...$field);
    }

    /**
     * Add new valid rule.
     *
     * @param string $field Field name
     *
     * @return Valid New rule Validation
     */
    public function field(string ...$field): Valid
    {
        $this->has_run_validate = false;

        return $this->valid_pool->rule(...$field);
    }

    /**
     * Add new filter rule.
     *
     * @param string $field Field name
     *
     * @return Filter New rule filter
     */
    public function filter(string ...$field): Filter
    {
        return $this->filter_pool->rule(...$field);
    }

    /**
     * Set fields or input for validation.
     *
     * @param array<string, mixed> $fields Field array to validate
     */
    public function fields($fields): self
    {
        foreach ($fields as $key => $field) {
            $this->fields[$key] = $field;
        }

        return $this;
    }

    /**
     * get fields or input validation.
     *
     * @return array<string, mixed> Fields
     */
    public function get_fields(): array
    {
        return $this->fields;
    }

    /**
     * Process the validation errors and return an array of errors with field names as keys.
     *
     * @return array<string, string> Validation errors
     *
     * @throws \Exception
     */
    public function get_error(): array
    {
        if (!$this->has_run_validate) {
            $this->Rule->validate($this->fields, $this->valid_pool->get_pool());
            $this->has_run_validate = true;
        }

        $this->set_messages();

        return $this->Rule->get_errors_array();
    }

    /**
     * Process the validation errors and return an array of errors with field names as keys.
     *
     * @return Collection<string, string> Validation errors
     *
     * @throws \Exception
     */
    public function errors(): Collection
    {
        return new Collection($this->get_error());
    }

    /**
     * Inline validation field.
     *
     * @param callable(ValidPool=): (ValidPool|mixed) $rule_validation Closure with param as ValidPool,
     *                                                                 if null return validate this currect validation
     */
    public function is_valid($rule_validation = null): bool
    {
        // load from property
        if ($rule_validation === null) {
            $this->has_run_validate = true;

            return $this->Rule->validate($this->fields, $this->valid_pool->get_pool()) !== true ? false : true;
        }

        // load from param (convert to ValidPool)
        $rules = $this->closure_to_validation($rule_validation)->get_pool();
        $this->Rule->validation_rules($rules);

        return $this->Rule->run($this->fields) === false
            ? false
            : true
        ;
    }

    /**
     * Inline validation field.
     * Invert from is_valid.
     *
     * @param callable(ValidPool=): (ValidPool|mixed) $rule_validation Closure with param as ValidPool,
     *                                                                 if null return validate this currect validation
     *
     * @return bool True if have a error
     */
    public function is_error($rule_validation = null): bool
    {
        return !$this->is_valid($rule_validation);
    }

    /**
     * Execute closuer when validation is true,
     * and return else statment.
     *
     * @param callable(ValidPool=): (ValidPool|mixed) $condition Excute closure
     */
    public function if_valid($condition): ValidationCondition
    {
        $val = $this->Rule->validate($this->fields, $this->valid_pool->get_pool());

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
     * @return bool Return true if validation valid
     *
     * @throws \Exception
     */
    public function validOrException(\Exception $exception = null)
    {
        if ($this->Rule->validate($this->fields, $this->valid_pool->get_pool()) === true) {
            return true;
        }

        throw $exception ?? new \Exception('vaildate if fallen', 1);
    }

    /**
     * Run validation, and get error when false.
     *
     * @return bool|array<int, string> Return true if validation valid
     */
    public function validOrError(\Exception $exception = null)
    {
        return $this->Rule->validate($this->fields, $this->valid_pool->get_pool());
    }

    /**
     * Filter the input data.
     *
     * @param callable(FilterPool=): (FilterPool|mixed) $rule_filter Closure of FilterPool
     *
     * @return array<string, mixed> Fields input after filter
     */
    public function filter_out($rule_filter = null)
    {
        if ($rule_filter === null) {
            /** @var array<string, mixed> */
            $filter = (array) $this->Rule->filter($this->fields, $this->filter_pool->get_pool());

            return $filter;
        }

        // overwrite input field
        $rules_filter          = $this->fields;
        // replace input field with filter
        foreach ($this->closure_to_filter($rule_filter)->get_pool() as $field => $rule) {
            $rules_filter[$field] = $rule->get_filter();
        }

        /** @var array<string, mixed> */
        $filter = (array) $this->Rule->filter($this->fields, $rules_filter);

        return $filter;
    }

    /**
     * Run validation and filter if success.
     *
     * @return bool|mixed True if validation failed,
     *                    array filter if validation valid
     */
    public function failedOrFilter()
    {
        if ($this->Rule->validate($this->fields, $this->valid_pool->get_pool()) === true) {
            return $this->filter_out();
        }

        return true;
    }

    /**
     * Change language for error messages.
     * Can effect before run validation or filter.
     *
     * @param string $lang Language
     */
    public function lang(string $lang): self
    {
        $this->Rule->lang($lang);

        return $this;
    }

    /**
     * Adding validation rule using ValidPool Callback.
     * Pass param as ValidPool in callback to adding rule.
     *
     * @param callable(ValidPool=): (ValidPool|mixed) $pools Closure with param as ValidPool
     */
    public function validation($pools): self
    {
        $this->valid_pool->combine(
            $this->closure_to_validation($pools)
        );

        return $this;
    }

    /**
     * Adding Filter rule using FilterPool Callback.
     * Pass param as FilterPool in callback to adding rule.
     *
     * @param callable(FilterPool=): (FilterPool|mixed) $pools Closure with param as FilterPool
     */
    public function filters($pools): self
    {
        $this->filter_pool->combine(
            $this->closure_to_filter($pools)
        );

        return $this;
    }

    /**
     * Helper to get rules from Closure.
     *
     * @param callable(ValidPool=): (ValidPool|mixed) $rule_validation closure of ValidPool
     *
     * @return ValidPool Validation rules
     */
    private function closure_to_validation($rule_validation): ValidPool
    {
        $pool  = new ValidPool();

        $return_closure = call_user_func_array($rule_validation, [$pool]);

        return $return_closure instanceof ValidPool
            ? $return_closure
            : $pool
        ;
    }

    /**
     * Helper to get rules from Closure.
     *
     * @param callable(FilterPool=): (FilterPool|mixed) $rule_filter closure of FillterPoll
     *
     * @return FilterPool Filter rules
     */
    private function closure_to_filter($rule_filter): FilterPool
    {
        $pool  = new FilterPool();

        $return_closure = call_user_func_array($rule_filter, [$pool]);

        return $return_closure instanceof FilterPool
            ? $return_closure
            : $pool
        ;
    }

    /** @var MessagePool[] */
    private $messages = [];

    /**
     * Set field-rule specific error messages.
     */
    public function messages(): MessagePool
    {
        return $this->messages[] = new MessagePool();
    }

    /**
     * Convert Messages class to array messages.
     */
    private function set_messages(): void
    {
        $messages = [];
        foreach ($this->messages as $messege_pool) {
            foreach ($messege_pool->Messages() as $filed => $message) {
                $messages[$filed] = $message;
            }
        }

        $this->Rule->set_fields_error_messages($messages);
    }

    /**
     * Check validation has submitted form.
     *
     * @return bool True if from submitted form
     */
    public function submitted(): bool
    {
        return isset($_SERVER['REQUEST_METHOD'])
            ? $_SERVER['REQUEST_METHOD'] === 'POST'
            : false;
    }

    /**
     * Validation field and submitted check.
     *
     * @return bool True if pass is_valid and submitted
     */
    public function passed(): bool
    {
        return $this->is_valid() && $this->submitted();
    }

    /**
     * Validation field and submitted check.
     * Invert method passed().
     *
     * @return bool True if not pass is_valid and submitted
     */
    public function fails(): bool
    {
        return !$this->passed();
    }

    /**
     * Filter validation only allow field.
     *
     * @param array<int, string> $fields Fields allow to validation
     */
    public function only(array $fields): self
    {
        $this->valid_pool->only($fields);

        return $this;
    }

    /**
     * Filter validation except some field.
     *
     * @param array<int, string> $fields Fields not allow to validation
     */
    public function except(array $fields): self
    {
        $this->valid_pool->except($fields);

        return $this;
    }
}
