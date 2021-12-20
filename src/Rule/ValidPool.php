<?php

declare(strict_types=1);

namespace Validator\Rule;

use Validator\Rule;

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
    public function rule(string $field)
    {
        return $this->pool[$field] = new Valid();
    }

    /**
     * Add new valid rule.
     *
     * @param string $field Field name
     *
     * @return Valid New rule Validation
     */
    public function __invoke(string $field)
    {
        return $this->rule($field);
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
}
