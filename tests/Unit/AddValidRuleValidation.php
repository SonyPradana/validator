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
    $validation = new Validator(['test' => 'test']);

    $validation->field('test')->max_len(4);
    $validation->field('test')->required();

    expect($validation->is_valid())->toBeTrue();
});

it('can add new valid rule with exist field using validpool', function () {
    $validation = new Validator(['test' => 'test']);
    $validation->validation(fn ($valid) => [
        $valid('test')->max_len(4),
        $valid('test')->required(),
    ]);

    expect($validation->is_valid())->toBeTrue();
});

// Multy --------------------------------------------------

it('can add multy field using method field', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid->field('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add multy field using method field with field exist', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test2']);

    $valid->field('test', 'test2')->required();
    $valid->field('test')->max_len(4);
    $valid->field('test2')->max_len(5);
    $valid->field('test', 'test2')->min_len(4);

    expect($valid->is_valid())->toBeTrue();
});

it('can add multy field using method __invoke', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add multy field using method __invoke with field exist', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test2']);

    $valid('test', 'test2')->required();
    $valid->field('test')->max_len(4);
    $valid->field('test2')->max_len(5);
    $valid('test', 'test2')->min_len(4);

    expect($valid->is_valid())->toBeTrue();
});
