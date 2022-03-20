<?php

declare(strict_types=1);

namespace Validator\Rule;

/**
 * @internal
 */
final class ValidPool
{
    /** @var array<int, array<string, string|Valid>> */
    private $pool = [];

    /**
     * Get entry valid rule.
     *
     * @return Valid[] Valid rule
     */
    public function get_pool()
    {
        $rules = [];
        foreach ($this->pool as $ruler) {
            $field = $ruler['field'];
            $rule  = $ruler['rule'];
            if ($rule instanceof Valid) {
                // @phpstan-ignore-next-line
                $exist_rule    = $rules[$field] ?? new Valid();
                // @phpstan-ignore-next-line
                $rules[$field] = $exist_rule->combine($rule);
            }
        }

        return $rules;
    }

    /**
     * Filter validation only allow field.
     *
     * @param array<int, string> $fields Fields allow to validation
     *
     * @return self
     */
    public function only(array $fields)
    {
        $this->pool = array_filter(
            $this->pool,
            fn ($field) => in_array($field['field'], $fields)
        );

        return $this;
    }

    /**
     * Filter validation expect allow field.
     *
     * @param array<int, string> $fields Fields allow to validation
     */
    public function except(array $fields): self
    {
        $this->pool = array_filter(
            $this->pool,
            fn ($field) => !in_array($field['field'], $fields)
        );

        return $this;
    }

    /**
     * Combine validation rule with other validation rule.
     *
     * @param ValidPool $validPool ValidPool class to combine
     *
     * @return self
     */
    public function combine(ValidPool $validPool)
    {
        foreach ($validPool->pool as $valid_rule) {
            $this->pool[] = $valid_rule;
        }

        return $this;
    }

    /**
     * Add new valid rule.
     *
     * @param string $field Field name
     *
     * @return Valid New rule Validation
     */
    public function rule(string ...$field)
    {
        return $this->set_field_rule(new Valid(), $field);
    }

    /**
     * Add new valid rule.
     *
     * @param string $field Field name
     *
     * @return Valid New rule Validation
     */
    public function __invoke(string ...$field)
    {
        return $this->rule(...$field);
    }

    /**
     * Add new valid rule.
     *
     * @param string $name Field name
     *
     * @return Valid New rule Validation
     */
    public function __get($name)
    {
        return $this->rule($name);
    }

    /**
     * Set new feild rule.
     *
     * @param string $name  Field name
     * @param string $value Validation Rule
     *
     * @return self
     */
    public function __set($name, $value)
    {
        $this->rule($name)->raw($value);

        return $this;
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
            $this->pool[] = [
                'field' => $field,
                'rule'  => $valid,
            ];
        }

        return $valid;
    }
}
