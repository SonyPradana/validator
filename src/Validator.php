<?php

declare(strict_types=1);

namespace Validator;

use Closure;
use Exception;
use Validator\Rule\Filter;
use Validator\Rule\FilterPool;
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
    /** @var Filter[] */
    private $filters = [];
    /** @var bool Check rule validate has run or not */
    private $has_run_validate = false;

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
     * Create validation and filter using static.
     *
     * @param string[] $fileds Field array to validate
     *
     * @return static
     */
    public static function make($fileds = [])
    {
        return new static($fileds);
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
        return $this->set_field_rule(new Valid(), $field);
    }

    /**
     * Helper to add multy rule in single method.
     *
     * @param Valid                     $valid  Instans for new validation rule
     * @param array<int|string, string> $fields Fields name
     *
     * @return Valid Rule Validation base from param
     */
    private function set_field_rule(Valid $valid, array $fields): Valid
    {
        foreach ($fields as $field) {
            $this->validations[$field] = $valid;
        }

        return $valid;
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
        return $this->set_filter_rule(new Filter(), $field);
    }

    /**
     * Helper to add multy filter rule in single method.
     *
     * @param Filter                    $valid   Instans for new filter rule
     * @param array<int|string, string> $filters Fields name
     *
     * @return Filter Rule filter base from param
     */
    private function set_filter_rule(Filter $valid, array $filters): Filter
    {
        foreach ($filters as $filter) {
            $this->filters[$filter] = $valid;
        }

        return $valid;
    }

    /**
     * Set fields or input for validation.
     *
     * @param array<string, string> $fields Field array to validate
     */
    public function fields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * get fields or input validation.
     *
     * @return array<string, string> Fields
     */
    public function get_fields(): array
    {
        return $this->fields;
    }

    /**
     * Process the validation errors and return an array of errors with field names as keys.
     *
     * @return array<int, string> Validation errors
     *
     * @throws Exception
     */
    public function get_error(): array
    {
        if (!$this->has_run_validate) {
            $this->Rule->validate($this->fields, $this->validations);
            $this->has_run_validate = true;
        }

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
            $this->has_run_validate = true;

            return $this->Rule->validate($this->fields, $this->validations) !== true ? false : true;
        }

        $rules = [];
        foreach ($this->valid_pools($rule_validation) as $field => $rule) {
            $rules[$field] = $rule->get_validation();
        }

        $this->Rule->validation_rules($rules);
        if ($this->Rule->run($this->fields) === false) {
            return false;
        }

        return true;
    }

    /**
     * Inline validation field.
     * Invert from is_valid.
     *
     * @param \Closure|null $rule_validation Closure with param as ValidPool,
     *                                       if null return validate this currect validation
     *
     * @return bool True if have a error
     */
    public function is_error(?Closure $rule_validation = null): bool
    {
        return !$this->is_valid($rule_validation);
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
        if ($this->Rule->validate($this->fields, $this->validations) === true) {
            return true;
        }

        throw $exception ?? new Exception('vaildate if fallen', 1);
    }

    /**
     * Run validation, and get error when false.
     *
     * @return bool|array<int, string> Return true if validation valid
     */
    public function validOrError(Exception $exception = null)
    {
        return $this->Rule->validate($this->fields, $this->validations);
    }

    /**
     * Filter the input data.
     *
     * @return mixed, string> Fields input after filter
     */
    public function filter_out(?Closure $rule_filter = null)
    {
        if ($rule_filter == null) {
            return $this->Rule->filter($this->fields, $this->filters);
        }

        // overwrite input field
        $rules_filter          = $this->fields;
        // replace input field with filter
        foreach ($this->filter_pools($rule_filter) as $field => $rule) {
            $rules_filter[$field] = $rule->get_filter();
        }

        return $this->Rule->filter($this->fields, $rules_filter);
    }

    /**
     * Run validation and filter if success.
     *
     * @return bool|mixed True if validation failed,
     *                    array filter if validation valid
     */
    public function failedOrFilter()
    {
        if ($this->Rule->validate($this->fields, $this->validations) === true) {
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
     * @param Closure $pools Closure with param as ValidPool
     */
    public function validation(Closure $pools): self
    {
        foreach ($this->valid_pools($pools) as $key => $rule) {
            $this->validations[$key] = $rule;
        }

        return $this;
    }

    /**
     * Adding Filter rule using FilterPool Callback.
     * Pass param as FilterPool in callback to adding rule.
     *
     * @param Closure $pools Closure with param as FilterPool
     */
    public function filters(Closure $pools): self
    {
        foreach ($this->filter_pools($pools) as $key => $rule) {
            $this->filters[$key] = $rule;
        }

        return $this;
    }

    /**
     * Helper to get rules from Closure.
     *
     * @param Closure $rule_validation ValidPool return or param
     *
     * @return Valid[] Validation rules
     */
    private function valid_pools(Closure $rule_validation): array
    {
        $pool  = new ValidPool();

        $return_closure = call_user_func_array($rule_validation, [$pool]);

        return $return_closure instanceof ValidPool
            ? $return_closure->get_pool()
            : $pool->get_pool()
        ;
    }

    /**
     * Helper to get rules from Closure.
     *
     * @param Closure $rule_filter FilterPool return or param
     *
     * @return Filter[] Filter rules
     */
    private function filter_pools(Closure $rule_filter): array
    {
        $pool  = new FilterPool();

        $return_closure = call_user_func_array($rule_filter, [$pool]);

        return $return_closure instanceof FilterPool
            ? $return_closure->get_pool()
            : $pool->get_pool()
        ;
    }
}
