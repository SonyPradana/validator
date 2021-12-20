<?php

declare(strict_types=1);

if (!function_exists('vr')) {
    /**
     * Alias for validation rule,
     * return string validation rule.
     *
     * @return \Validator\Rule\Valid
     */
    function vr(): Validator\Rule\Valid
    {
        return new \Validator\Rule\Valid();
    }
}

if (!function_exists('validate')) {
    /**
     * Alias for validator
     *
     * @param array $feild Feild input
     *
     * @return \Validator\Validator
     */
    function validate(array $feild): Validator\Validator
    {
        return new \Validator\Validator($feild);
    }
}
