<?php

declare(strict_types=1);

namespace Validator;

use Closure;

/**
 * @internal
 */
final class ValidationCondition
{
    /** @var array<int, string> */
    private $error;

    /**
     * Helper for catch error validation from if_valid condition.
     *
     * @param false|array<int, string> $error Set error for else condition
     */
    public function __construct($error)
    {
        $this->error = $error === false ? [] : $error;
    }

    /**
     * Execute else condition closure,
     * when validation is false.
     *
     * Error message send using param closure
     *
     * @param \Closure $condition Excute condtion
     */
    public function else(\Closure $condition): void
    {
        call_user_func($condition, $this->error);
    }
}
