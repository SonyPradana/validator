<?php

use Validator\Validator;

// empty rule valdation rule
it('empty rule not make runtime error', function () {
    $valid = new Validator(['test' => 'test']);
    // set empty rull
    $valid->field('test');
    expect($valid->is_valid())->toBeTrue();
});

it('using \'not\' with empty rule not make runtime error', function () {
    $valid = new Validator(['test' => 'test']);
    // set empty rull
    $valid->field('test')->not();
    expect($valid->is_valid())->toBeTrue();
});
