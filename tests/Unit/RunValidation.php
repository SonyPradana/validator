<?php

use Validator\Rule\ValidPool;
use Validator\Validator;

// run validation
it('can run validation using method is_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can run validation using method passed', function () {
    $_SERVER['REQUEST_METHOD']  = 'POST';
    $valid                      = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_valid())->toBeTrue();
});

it('validation false because method pass required valid validation', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';

    expect(Validator::make()->validation(fn (ValidPool $v) => [
        $v('test')->required(),
    ])->passed())->toBeFalse();
});

it('validation false because method pass required submitted form', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    expect(Validator::make()->passed())->toBeFalse();
});

it('validation false because method pass required submitted form and valid validation', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    expect(Validator::make()->validation(fn (ValidPool $v) => [
        $v('test')->required(),
    ])->passed())->toBeFalse();
});

it('can run validation using method is_valid with closure (param)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
        'test6' => 'test',
        'test7' => 'test',
    ]);

    expect($valid->is_valid(
        fn (ValidPool $pool) => [
            $pool->rule('test1')->required(),
            $pool('test2')->required(),
            $pool->test3->required(),
            $pool->rule('test4', 'test5')->required(),
            $pool('test6', 'test7')->required(),
        ]
    ))->toBeTrue();
});

it('can run validation using method is_valid with closure (return)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
    ]);

    expect($valid->is_valid(function () {
        $pool = new ValidPool();
        $pool->rule('test1')->required();
        $pool('test2')->required();
        $pool->test3->required();
        $pool->rule('test4', 'test5')->required();

        return $pool;
    }))->toBeTrue();
});

it('can run validation using method if_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    $valid->if_valid(function () {
        expect(true)->toBeTrue();
    })->else(function ($err) {
        expect($err)->toBe([]);
    });
});

it('can run validation using method validOrException', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->validOrException())->toBeTrue();
});

it('can run validation using method validOrException but not valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required()->min_len(5);
    $valid->validOrException();
})->throws('vaildate if fallen');

it('can run validation using method validOrError', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->validOrError())->toBeTrue();
});

it('can run validation using method validOrError but not valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required()->min_len(5);

    expect($valid->validOrError())->toBeArray();
});

test('method is_error() is invert as method is_valid()', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_error())->toBeFalse();
    expect($valid->is_error())->not->toEqual($valid->is_valid());
});

test('method fails() is invert as method passed()', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->fails())->toBeFalse();
    expect($valid->fails())->not->toEqual($valid->passed());
});
