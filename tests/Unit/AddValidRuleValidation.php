<?php

use Validator\Rule\ValidPool;
use Validator\Validator;

// add validation
it('can add validation using method field', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add validation using __get', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add validation using __invoke', function () {
    $valid = new Validator(['test' => 'test']);

    $valid('test')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add validator rule using method validation (param)', function () {
    $v = Validator::make(['test' => 123])
        ->validation(function () {
            $v = new ValidPool();
            $v('test')->required();
            $v('d')->alpha();

            return $v;
        })->is_valid();

    expect($v)->toBeTrue();
});

it('can add validator rule using method validation (return)', function () {
    $v = Validator::make(['test' => 123])
        ->validation(fn (ValidPool $v) => [
            $v('test')->required(),
            $v('d')->alpha(),
        ])->is_valid();

    expect($v)->toBeTrue();
});

it('can add validator rule using pools callback from method make() (param)', function () {
    $v = Validator::make(['test' => 123], fn (ValidPool $v) => [
        $v('test')->required(),
        $v('d')->alpha(),
    ])->is_valid();

    expect($v)->toBeTrue();
});

it('can add validator rule using pools callback from method make() (return)', function () {
    $v = Validator::make(['test' => 123], function () {
        $v = new ValidPool();
        $v('test')->required();
        $v('d')->alpha();

        return $v;
    })->is_valid();

    expect($v)->toBeTrue();
});

it('can add new valid rule with exist field', function () {
    $validation = new Validator();

    $validation->field('test', 'test2')->required();
    $validation->field('test')->max_len(1);
    $validation->field('test2')->max_len(1);

    // must error, field 'test' is required
    expect($validation->is_error())->toBeTrue();
});

it('can add new valid rule with exist field using validpool', function () {
    $validation = new Validator();
    $validation->validation(fn ($valid) => [
        $valid('test')->required(),
        $valid('test')->max_len(1),
    ]);

    // must error, field 'test' is required
    expect($validation->is_error())->toBeTrue();
});

// Multy --------------------------------------------------

it('can add multy field using method field', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid->field('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add multy field using method __invoke', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});
