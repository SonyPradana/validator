<?php

declare(strict_types=1);

namespace Validator\Rule;

/**
 * @internal
 */
final class FilterPool
{
    /** @var array<int, array<string, string|Filter>> */
    private $pool = [];

    /**
     * Get entry filter rule.
     *
     * @return Filter[] Filter rule
     */
    public function get_pool()
    {
        $rules = [];
        foreach ($this->pool as $ruler) {
            $field = $ruler['field'];
            $rule  = $ruler['rule'];
            if ($rule instanceof Filter) {
                // @phpstan-ignore-next-line
                $exist_rule    = $rules[$field] ?? new Filter();
                // @phpstan-ignore-next-line
                $rules[$field] = $exist_rule->combine($rule);
            }
        }

        return $rules;
    }

    /**
     * Combine filter rule with other filter rule.
     *
     * @param FilterPool $filterPool FilterPool class to combine
     *
     * @return self
     */
    public function combine(FilterPool $filterPool)
    {
        foreach ($filterPool->pool as $valid_rule) {
            $this->pool[] = $valid_rule;
        }

        return $this;
    }

    /**
     * Filter filter only allow field.
     *
     * @param array<int, string> $fields Fields allow to filter
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
     * Filter filter expect allow field.
     *
     * @param array<int, string> $fields Fields allow to filter
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
     * Add new Filter rule.
     *
     * @param string $field Field name
     *
     * @return Filter New rule filter
     */
    public function rule(string ...$field)
    {
        return $this->set_filter_rule(new Filter(), $field);
    }

    /**
     * Add new filter rule.
     *
     * @param string $field Field name
     *
     * @return Filter New rule filter
     */
    public function __invoke(string ...$field)
    {
        return $this->rule(...$field);
    }

    /**
     * Add new filter rule.
     *
     * @param string $name Field name
     *
     * @return Filter New rule filter
     */
    public function __get($name)
    {
        return $this->rule($name);
    }

    /**
     * Set new feild rule.
     *
     * @param string $name  Field name
     * @param string $value Filter Rule
     *
     * @return self
     */
    public function __set($name, $value)
    {
        $this->rule($name)->raw($value);

        return $this;
    }

    /**
     * Helper to add multy filter rule in single method.
     *
     * @param Filter                    $filter Instans for new filter rule
     * @param array<int|string, string> $fields Fields name
     *
     * @return Filter Rule filter base from param
     */
    private function set_filter_rule(Filter $filter, array $fields): Filter
    {
        foreach ($fields as $field) {
            $this->pool[] = [
                'field' => $field,
                'rule'  => $filter,
            ];
        }

        return $filter;
    }
}
