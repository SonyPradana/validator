<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * Trait contain invert exist validation method from parent.
 *
 * TODO: check every method with GUMP method
 */
trait InvertValidationTrait
{
    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_required($field, array $input, array $params = [], $value)
    {
        return !$this->validate_required($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_contains($field, array $input, array $params = [], $value)
    {
        return !$this->validate_contains($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_contain_list($field, array $input, array $params = [], $value)
    {
        return !$this->validate_contains($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_doesnt_contain_list($field, array $input, array $params = [], $value)
    {
        return !$this->validate_doesnt_contain_list($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_boolean($field, array $input, array $params = [], $value)
    {
        return !$this->validate_boolean($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_email($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_email($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_max_len($field, array $input, array $params = [], $value)
    {
        return !$this->validate_max_len($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_min_len($field, array $input, array $params = [], $value)
    {
        return !$this->validate_min_len($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_exact_len($field, array $input, array $params = [], $value)
    {
        return !$this->validate_exact_len($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_between_len($field, array $input, array $params = [], $value)
    {
        return !$this->validate_between_len($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha_numeric($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha_numeric($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha_dash($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha_dash($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha_numeric_dash($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha_numeric_dash($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha_numeric_space($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha_numeric_space($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_alpha_space($field, array $input, array $params = [], $value)
    {
        return !$this->validate_alpha_space($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_numeric($field, array $input, array $params = [], $value)
    {
        return !$this->validate_numeric($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_integer($field, array $input, array $params = [], $value)
    {
        return !$this->validate_integer($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_float($field, array $input, array $params = [], $value)
    {
        return !$this->validate_float($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_url($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_url($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_url_exists($field, array $input, array $params = [], $value)
    {
        return !$this->validate_url_exists($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_ip($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_ip($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_ipv4($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_ipv4($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_ipv6($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_ipv6($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_cc($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_cc($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_name($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_name($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_street_address($field, array $input, array $params = [], $value)
    {
        return !$this->validate_street_address($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_iban($field, array $input, array $params = [], $value)
    {
        return !$this->validate_iban($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_date($field, array $input, array $params = [], $value)
    {
        return !$this->validate_date($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_min_age($field, array $input, array $params = [], $value)
    {
        return !$this->validate_min_age($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_max_numeric($field, array $input, array $params = [], $value)
    {
        return !$this->validate_max_numeric($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_min_numeric($field, array $input, array $params = [], $value)
    {
        return !$this->validate_min_numeric($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_starts($field, array $input, array $params = [], $value)
    {
        return !$this->validate_starts($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_required_file($field, array $input, array $params = [], $value)
    {
        return !$this->validate_required_file($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_extension($field, array $input, array $params = [], $value)
    {
        return !$this->validate_extension($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_equalsfield($field, array $input, array $params = [], $value)
    {
        return !$this->validate_equalsfield($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_guidv4($field, array $input, array $params = [], $value)
    {
        return !$this->validate_guidv4($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_phone_number($field, array $input, array $params = [], $value)
    {
        return !$this->validate_phone_number($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_regex($field, array $input, array $params = [], $value)
    {
        return !$this->validate_regex($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_json_string($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_json_string($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_array_size_greater($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_array_size_greater($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_array_size_lesser($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_array_size_lesser($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_array_size_equal($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_array_size_equal($field, $input, $params, $value);
    }

    /**
     * Invert with
     *
     * @param string $field
     * @param array<int, string> $input
     * @param array<int, string> $params
     * @param mixed $value
     *
     * @return bool
     */
    protected function validate_invert_valid_twitter($field, array $input, array $params = [], $value)
    {
        return !$this->validate_valid_twitter($field, $input, $params, $value);
    }
}
