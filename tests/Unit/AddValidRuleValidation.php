<?php

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

it('can add validation using invoke', function () {
    $valid = new Validator(['test' => 'test']);

    $valid('test')->required();

    expect($valid->is_valid())->toBeTrue();
});
