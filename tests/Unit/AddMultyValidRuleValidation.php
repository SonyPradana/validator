<?php

use Validator\Validator;

// can add multi validate rule
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
