<?php

declare(strict_types=1);

namespace Validator;

use Validator\Traits\CostumeFilterTrait;
use Validator\Traits\CostumeValidationTrait;
use Validator\Traits\InvertValidationTrait;

/**
 * @internal
 */
final class Rule extends \GUMP
{
    // validation
    use InvertValidationTrait;
    use CostumeValidationTrait;
    // filter
    use CostumeFilterTrait;

    /**
     * Change language for error messages.
     * Can effect before run validation or filter.
     *
     * @param string $lang Language
     */
    public function lang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get all error messages.
     *
     * @return array<string, string>
     */
    protected function get_messages()
    {
        $messages = parent::get_messages();

        // add inveret costume validate message
        foreach ($messages as $rule => $message) {
            $rule_key = 'invert_' . $rule;
            if (!isset($messages[$rule_key])) {
                $messages[$rule_key] = $message;
            }
        }

        return $messages;
    }
}
