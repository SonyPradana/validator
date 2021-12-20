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
}
