<?php

declare(strict_types=1);

namespace Validator\Rule;

use Closure;
use Exception;
use Validator\Rule;

/**
 * @internal
 */
final class Filter
{
    /** @var string[] */
    private $filter_rule = [];

    /** @var string */
    private $delimiter = '|';

    public function __construct()
    {
        $this->delimiter = Rule::$rules_delimiter;
    }

    /**
     * Function to create and return previously created instance.
     *
     * @return Filter
     */
    public static function with(): self
    {
        return new static();
    }

    /**
     *  @return string Rule of Filter
     */
    public function get_filter(): string
    {
        $is_block_if     = false;
        $filters_rule    = [];

        foreach ($this->filter_rule as $rule) {
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

            // add string rule and reset invert rule
            $filters_rule[]    = $rule;
            $is_invert         = false;
        }

        return implode($this->delimiter, $filters_rule);
    }

    /**
     * Combine filter rule with other filter rule.
     *
     * @param Filter $filter Filter class to combine
     */
    public function combine(Filter $filter): self
    {
        foreach ($filter->filter_rule as $rule) {
            $this->filter_rule[] = $rule;
        }

        return $this;
    }

    /**
     * @return string Rule of filter
     */
    public function __toString(): string
    {
        return $this->get_filter();
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
            $this->filter_rule = [];
        }

        // prevent create new rule and give a string rule
        return $this->get_filter();
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
        $this->filter_rule[] = $result
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
        $this->filter_rule[] = 'end_if';

        return $this;
    }

    /**
     * Adding costume Fillter.
     *
     * @param Closure $costume_filter Callable return as string,
     *                                can contain param as ($value. $param)
     *
     * @return self
     */
    public function filter(Closure $costume_filter)
    {
        if (is_callable($costume_filter)) {
            $byte           = random_bytes(3);
            $hex            = bin2hex($byte);
            $rule_name      = 'filter_' . $hex;

            Rule::add_filter($rule_name, $costume_filter);

            $this->filter_rule[] = $rule_name;
        }

        return $this;
    }

    /**
     * Add filter rule with raw (string) rule.
     *
     * @param string $raw_rule Raw rule
     *
     * @return self
     */
    public function raw($raw_rule)
    {
        $this->filter_rule[] = $raw_rule;

        return $this;
    }
    // Filter -------------------------------------------------------

    /**
     * Replace noise words in a string.
     */
    public function noise_words(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Remove all known punctuation from a string.
     */
    public function rmpunctuation(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by urlencoding characters.
     */
    public function urlencode(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by converting HTML characters to their HTML entities.
     */
    public function htmlencode(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by removing illegal characters from emails.
     */
    public function sanitize_email(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by removing illegal characters from numbers.
     */
    public function sanitize_numbers(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by removing illegal characters from float numbers.
     */
    public function sanitize_floats(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Sanitize the string by removing any script tags.
     */
    public function sanitize_string(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Converts ['1', 1, 'true', true, 'yes', 'on'] to true,
     * anything else is false ('on' is useful for form checkboxes).
     */
    public function boolean(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Filter out all HTML tags except the defined basic tags.
     */
    public function basic_tags(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Convert the provided numeric value to a whole number.
     */
    public function whole_number(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Convert MS Word special characters to web safe characters.
     */
    public function ms_word_characters(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Converts to lowercase.
     */
    public function lower_case(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Converts to uppercase.
     */
    public function upper_case(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Converts value to url-web-slugs.
     */
    public function slug(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }

    /**
     * Remove spaces from the beginning and end of strings (PHP).
     */
    public function trim(): self
    {
        $this->filter_rule[] = __FUNCTION__;

        return $this;
    }
}
