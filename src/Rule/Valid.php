<?php

declare(strict_types=1);

namespace Validator\Rule;

use Closure;
use Exception;
use Validator\Rule;

/**
 * @internal
 *
 * @property self $not
 */
final class Valid
{
    /** @var string[] */
    private $validation_rule = [];

    /** @var string */
    private $delimiter = '|';
    /** @var string */
    private $parameters_delimiter = ',';
    /** @var string */
    private $parameters_arrays_delimiter = ';';

    public function __construct()
    {
        $this->delimiter                   = Rule::$rules_delimiter;
        $this->parameters_delimiter        = Rule::$rules_parameters_delimiter;
        $this->parameters_arrays_delimiter = Rule::$rules_parameters_arrays_delimiter;
    }

    /**
     * Function to create and return previously created instance.
     *
     * @return Valid
     */
    public static function with(): self
    {
        return new static();
    }

    /**
     *  @return string Rule of validation
     */
    public function get_validation(): string
    {
        $is_invert       = false;
        $is_block_if     = false;
        $validation_rule = [];

        foreach ($this->validation_rule as $rule) {
            // detect if condition
            if ($rule === 'if_false') {
                $is_block_if = true;
                continue;
            }
            if ($rule === 'if_true' || $rule === 'end_if') {
                // break if statment
                $is_block_if = false;
                continue;
            }
            // block rule if statment is false
            if ($is_block_if === true) {
                continue;
            }

            // set next rule as invert rule
            if ($rule === 'invert') {
                $is_invert = !$is_invert;
                continue;
            }

            // add string rule and reset invert rule
            $validation_rule[] = $is_invert ? 'invert_' . $rule : $rule;
            $is_invert         = false;
        }

        return implode($this->delimiter, $validation_rule);
    }

    /**
     * @return string Rule of validation
     */
    public function __toString(): string
    {
        return $this->get_validation();
    }

    /**
     * Access method from property.
     *
     * @param string $name Name of property or method
     *
     * @return self
     */
    public function __get($name)
    {
        if ($name === 'not') {
            return $this->not();
        }

        return $this;
    }

    /**
     * Set validation to invert result.
     */
    public function not(): self
    {
        $this->validation_rule[] = 'invert';

        return $this;
    }

    /**
     * Rule will be applay if condition is true,
     * otherwise rule be reset (not set) if return false.
     *
     * Reset only boolean false.
     *
     * @param Closure $condition Closure return boolean
     */
    public function where(Closure $condition): string
    {
        // get return closure
        $result = call_user_func_array($condition, []);
        // throw exception if closure not return boolean
        if (!is_bool($result)) {
            throw new Exception('Condition closure not return boolean', 1);
        }

        // false condition
        if ($result === false) {
            $this->validation_rule = [];
        }

        // prevent create new rule and give a string rule
        return $this->get_validation();
    }

    /**
     * Rule will be applay if condition is true,
     * otherwise rule be skip if return false.
     *
     * Reset only boolean false.
     *
     * @param Closure $condition Closure return boolean
     */
    public function if(Closure $condition): self
    {
        // get return closure
        $result = call_user_func_array($condition, []);
        // throw exception if closure not return boolean
        if (!is_bool($result)) {
            throw new Exception('Condition closure not return boolean', 1);
        }

        // add condition to rule
        $this->validation_rule[] = $result
            ? 'if_true'
            : 'if_false'
        ;

        return $this;
    }

    /**
     * Set end rule of 'if' statment.
     */
    public function end_if(): self
    {
        $this->validation_rule[] = 'end_if';

        return $this;
    }

    // -------------------------------------------------------

    /**
     * Ensures the specified key value exists and is not empty
     * (not null, not empty string, not empty array).
     */
    public function required(): self
    {
        $this->validation_rule[] = (string) 'required';

        return $this;
    }

    /**
     * Verify that a value is contained within the pre-defined value set.
     */
    public function contains(string ...$contain): self
    {
        $str_contain             = implode($this->parameters_arrays_delimiter, $contain);
        $delimeter               = $this->parameters_delimiter;
        $this->validation_rule[] = (string) "contains$delimeter$str_contain";

        return $this;
    }

    /**
     * Verify that a value is contained within the pre-defined value set.
     * Error message will NOT show the list of possible values.
     *
     * @param string ...$contain Contain
     */
    public function contains_list(...$contain): self
    {
        $str_contain = implode($this->parameters_arrays_delimiter, $contain);

        $delimeter               = $this->parameters_delimiter;
        $this->validation_rule[] = (string) "contains_list$delimeter$str_contain";

        return $this;
    }

    /**
     * Verify that a value is contained within the pre-defined value set.
     * Error message will NOT show the list of possible values.
     *
     * @param string ...$contain Contain
     */
    public function doesnt_contain_list(...$contain): self
    {
        $str_contain = implode($this->parameters_arrays_delimiter, $contain);

        $delimeter               = $this->parameters_delimiter;
        $this->validation_rule[] = (string) "doesnt_contain_list$delimeter$str_contain";

        return $this;
    }

    /**
     * Determine if the provided value is a valid boolean.
     * Returns true for: yes/no, on/off, 1/0, true/false.
     * In strict mode (optional) only true/false will be valid which you can combine with boolean filter.
     *
     * @param bool $strict only true/false will be valid which you can combine with boolean filter
     */
    public function boolean(bool $strict = true): self
    {
        $use_strict              = $strict ? $this->parameters_delimiter . 'strict' : '';
        $this->validation_rule[] = (string) "boolean$use_strict";

        return $this;
    }

    /**
     * Determine if the provided email has valid format.
     */
    public function valid_email(): self
    {
        $this->validation_rule[] = 'valid_email';

        return $this;
    }

    /**
     * Determine if the provided value length is less or equal to a specific value.
     *
     * @param int $len Maksimem lenght
     */
    public function max_len(int $len): self
    {
        $this->validation_rule[] = 'max_len' . $this->parameters_delimiter . $len;

        return $this;
    }

    /**
     * Determine if the provided value length is more or equal to a specific value.
     *
     * @param int $len Minimem lenght
     */
    public function min_len(int $len): self
    {
        $this->validation_rule[] = 'min_len' . $this->parameters_delimiter . $len;

        return $this;
    }

    /**
     * Determine if the provided value length matches a specific value.
     *
     * @param int $len Excat lenght
     */
    public function exact_len(int $len): self
    {
        $this->validation_rule[] = 'exact_len' . $this->parameters_delimiter . $len;

        return $this;
    }

    /**
     * Determine if the provided value length is between min and max values.
     *
     * @param int $min_len Minimem lenght
     * @param int $max_len Maksimem lenght
     */
    public function between_len(int $min_len, int $max_len): self
    {
        $this->validation_rule[] = 'between_len' . $this->parameters_delimiter . $min_len . $this->parameters_arrays_delimiter . $max_len;

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha characters.
     */
    public function alpha(): self
    {
        $this->validation_rule[] = 'alpha';

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha-numeric characters.
     */
    public function alpha_numeric(): self
    {
        $this->validation_rule[] = 'alpha_numeric';

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha characters with dashed and underscores.
     */
    public function alpha_dash(): self
    {
        $this->validation_rule[] = 'alpha_dash';

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha numeric characters with dashed and underscores.
     */
    public function alpha_numeric_dash(): self
    {
        $this->validation_rule[] = 'alpha_numeric_dash';

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha numeric characters with spaces.
     */
    public function alpha_numeric_space(): self
    {
        $this->validation_rule[] = 'alpha_numeric_space';

        return $this;
    }

    /**
     * Determine if the provided value contains only alpha characters with spaces.
     */
    public function alpha_space(): self
    {
        $this->validation_rule[] = 'alpha_space';

        return $this;
    }

    /**
     * Determine if the provided value is a valid number or numeric string.
     */
    public function numeric(): self
    {
        $this->validation_rule[] = 'numeric';

        return $this;
    }

    /**
     * Determine if the provided value is a valid integer.
     */
    public function integer(): self
    {
        $this->validation_rule[] = 'integer';

        return $this;
    }

    /**
     * Determine if the provided value is a valid float.
     */
    public function float(): self
    {
        $this->validation_rule[] = 'float';

        return $this;
    }

    /**
     * Determine if the provided value is a valid URL.
     */
    public function valid_url(): self
    {
        $this->validation_rule[] = 'valid_url';

        return $this;
    }

    /**
     * Determine if a URL exists & is accessible.
     */
    public function url_exists(): self
    {
        $this->validation_rule[] = 'url_exists';

        return $this;
    }

    /**
     * Determine if the provided value is a valid IP address.
     */
    public function valid_ip(): self
    {
        $this->validation_rule[] = 'valid_ip';

        return $this;
    }

    /**
     * Determine if the provided value is a valid IPv4 address.
     */
    public function valid_ipv4(): self
    {
        $this->validation_rule[] = 'valid_ipv4';

        return $this;
    }

    /**
     * Determine if the provided value is a valid IPv6 address.
     */
    public function valid_ipv6(): self
    {
        $this->validation_rule[] = 'valid_ipv6';

        return $this;
    }

    /**
     * Determine if the input is a valid credit card number.
     */
    public function valid_cc(): self
    {
        $this->validation_rule[] = 'valid_cc';

        return $this;
    }

    /**
     * Determine if the input is a valid human name.
     */
    public function valid_name(): self
    {
        $this->validation_rule[] = 'valid_name';

        return $this;
    }

    /**
     * Determine if the provided input is likely to be a street address using weak detection.
     */
    public function street_address(): self
    {
        $this->validation_rule[] = 'street_address';

        return $this;
    }

    /**
     * Determine if the provided value is a valid IBAN.
     */
    public function iban(): self
    {
        $this->validation_rule[] = 'iban';

        return $this;
    }

    /**
     * Determine if the provided input is a valid date (ISO 8601) or specify a custom format (optional).
     *
     * @param string $valid_date String date with format d/m/Y
     */
    public function date(string $valid_date): self
    {
        $this->validation_rule[] = 'date' . $this->parameters_delimiter . $valid_date;

        return $this;
    }

    /**
     * Determine if the provided input meets age requirement (ISO 8601).
     * Input should be a date (Y-m-d).
     *
     * @param int $age Age in integer
     */
    public function min_age(int $age): self
    {
        $this->validation_rule[] = 'min_age' . $this->parameters_delimiter . $age;

        return $this;
    }

    /**
     * Determine if the provided numeric value is lower or equal to a specific value.
     *
     * @param int $num Maximum Number
     */
    public function max_numeric(int $num): self
    {
        $this->validation_rule[] = 'max_numeric' . $this->parameters_delimiter . $num;

        return $this;
    }

    /**
     * Determine if the provided numeric value is higher or equal to a specific value.
     *
     * @param int $num Minimem Number
     */
    public function min_numeric(int $num): self
    {
        $this->validation_rule[] = 'min_numeric' . $this->parameters_delimiter . $num;

        return $this;
    }

    /**
     * Determine if the provided value starts with param.
     *
     * @param string $start_with Starts with
     */
    public function starts(string $start_with): self
    {
        $this->validation_rule[] = 'starts' . $this->parameters_delimiter . $start_with;

        return $this;
    }

    /**
     * Determine if the file was successfully uploaded.
     */
    public function required_file(): self
    {
        $this->validation_rule[] = 'required_file';

        return $this;
    }

    /**
     * Check the uploaded file for extension.
     * Doesn't check mime-type yet.
     *
     * @param string $extension Extention without dot
     */
    public function extension(string ...$extension): self
    {
        $str_contain = implode($this->parameters_arrays_delimiter, $extension);

        $delimeter               = $this->parameters_delimiter;
        $this->validation_rule[] = (string) "extension$delimeter$str_contain";

        return $this;
    }

    /**
     * Determine if the provided field value equals current field value.
     *
     * @param string $field_name Field value equals with
     */
    public function equals_field(string $field_name): self
    {
        $this->validation_rule[] = 'equalsfield' . $this->parameters_delimiter . $field_name;

        return $this;
    }

    /**
     * Determine if the provided field value is a valid GUID (v4).
     */
    public function guidv4(): self
    {
        $this->validation_rule[] = 'guidv4';

        return $this;
    }

    /**
     * Determine if the provided value is a valid phone number.
     */
    public function phone_number(): self
    {
        $this->validation_rule[] = 'phone_number';

        return $this;
    }

    /**
     * Custom regex validator.
     *
     * @param string $regex Custom regex
     */
    public function regex(string $regex): self
    {
        $this->validation_rule[] = 'regex' . $this->parameters_delimiter . $regex;

        return $this;
    }

    /**
     * Determine if the provided value is a valid JSON string.
     */
    public function valid_json_string(): self
    {
        $this->validation_rule[] = 'valid_json_string';

        return $this;
    }

    /**
     * Check if an input is an array and if the size is more or equal to a specific value.
     *
     * @param int $array_size Array dept size
     */
    public function valid_array_size_greater(int $array_size): self
    {
        $this->validation_rule[] = 'valid_array_size_greater' . $this->parameters_delimiter . $array_size;

        return $this;
    }

    /**
     * Check if an input is an array and if the size is less or equal to a specific value.
     *
     * @param int $array_size Array dept size
     */
    public function valid_array_size_lesser(int $array_size): self
    {
        $this->validation_rule[] = 'valid_array_size_lesser' . $this->parameters_delimiter . $array_size;

        return $this;
    }

    /**
     * Check if an input is an array and if the size is equal to a specific value.
     *
     * @param int $array_size Array dept size
     */
    public function valid_array_size_equal(int $array_size): self
    {
        $this->validation_rule[] = 'valid_array_size_equal' . $this->parameters_delimiter . $array_size;

        return $this;
    }

    /**
     * Determine if the provided value is a valid Twitter account.
     */
    public function valid_twitter(): self
    {
        $this->validation_rule[] = 'valid_twitter';

        return $this;
    }
}
