<?php

declare(strict_types=1);

namespace Validator\Rule;

/**
 * @internal
 */
final class ValidPool
{
    /** @var Valid[] */
    private $pool = [];

    /**
     * Get entry valid rule.
     *
     * @return Valid[] Valid rule
     */
    public function get_pool()
    {
        return $this->pool;
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
            $this->pool[$field] = $valid;
        }

        return $valid;
    }
}
