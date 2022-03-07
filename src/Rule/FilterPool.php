<?php

declare(strict_types=1);

namespace Validator\Rule;

/**
 * @internal
 */
final class FilterPool
{
    /** @var Filter[] */
    private $pool = [];

    /**
     * Get entry filter rule.
     *
     * @return Filter[] Filter rule
     */
    public function get_pool()
    {
        return $this->pool;
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
            $rule               = $this->pool[$field] ?? $filter;
            $this->pool[$field] = $filter->combine($rule);
        }

        return $filter;
    }
}
