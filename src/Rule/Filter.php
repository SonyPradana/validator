<?php

declare(strict_types=1);

namespace Validator\Rule;

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
        return implode($this->delimiter, $this->filter_rule);
    }

    /**
     * @return string Rule of filter
     */
    public function __toString(): string
    {
        return $this->get_filter();
    }

    // -------------------------------------------------------

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
