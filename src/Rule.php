<?php

declare(strict_types=1);

namespace Validator;

use GUMP;
use Validator\Traits\InvertValidationTrait;

/**
 * @internal
 */
final class Rule extends GUMP
{
    use InvertValidationTrait;

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
}
