<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * Trait contain Costume Filter.
 */
trait CostumeFilterTrait
{
    /**
     * Filter doest perfome anythink.
     * Costume rule to prevent runtime error when validation is empty.
     *
     * @param mixed                 $value
     * @param array<string, string> $params
     *
     * @return mixed
     */
    protected function filter_($value, array $params = [])
    {
        return $value;
    }
}
