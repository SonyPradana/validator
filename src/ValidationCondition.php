<?php

declare(strict_types=1);

namespace Validator;

use Closure;

/**
 * @internal
 */
final class ValidationCondition
{
    /** @var array */
    private $error;

    /**
     * Helper for catch error validation from if_valid condition
     *
     * @param array Set error for else condition
     */
    public function __construct(array $error)
    {
        $this->error = $error;
    }

    /**
     * Execute else condition closure,
     * when validation is false.
     *
     * Error message send using param closure
     *
     * @param Closure $condition Excute condtion
     */
    public function else(Closure $condition): void
    {
        call_user_func($condition, $this->error);
    }
}
