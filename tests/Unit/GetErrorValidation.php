<?php

use Validator\Validator;

// get error message
it('can get error message when valadation is fallen using method get_error', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    expect($valid->get_error())->toHaveCount(1);
});

it('can get error message when valadation is fallen using method if_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    $valid->if_valid(function () {
        expect(true)->toBeTrue();
    })->else(function ($err) {
        expect($err)->toHaveCount(1);
    });
});

it('can get error message when valadation is fallen using method validOrError', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    expect($valid->validOrError())->toHaveCount(1);
});
