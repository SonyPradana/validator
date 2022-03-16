<?php

use Validator\Validator;

it('can add costume validation', function () {
    $validation = new Validator(['test' => 2]);

    $validation->field('test')->valid(
        fn ($field, $input, $param, $value) => true,
        'This field is not odd number'
    );

    expect($validation->is_valid())->toBeTrue();
});

it('can add costume validation (not)', function () {
    $validation = new Validator(['test' => 2]);

    $validation->field('test')->not->valid(
        fn ($field, $input, $param, $value) => true,
        'This field is not odd number'
    );

    expect($validation->is_valid())->toBeFalse();
});

it('can add costume validation combine with other', function () {
    $validation = new Validator(['test' => 22]);

    $validation->field('test')->valid(
        fn ($field, $input, $param, $value) => true,
        'This field is not odd number'
    )->min_len(2);

    expect($validation->is_valid())->toBeTrue();
});

it('can add costume validation (not) combine with other', function () {
    $validation = new Validator(['test' => 2]);

    $validation->field('test')->not->valid(
        fn ($field, $input, $param, $value) => true,
        'This field is not odd number'
    )->min_len(2);

    expect($validation->is_valid())->toBeFalse();
});

it('can add costume message validation', function () {
    $validation = new Validator(['test' => 2]);

    $validation->field('test')->valid(
        fn ($field, $input, $param, $value) => false,
        'Costume error - {field}'
    );

    expect($validation->errors->all())->toMatchArray([
        'test' => 'Costume error - Test',
    ]);
});

it('can add costume message validation (not)', function () {
    $validation = new Validator(['test' => 2]);

    $validation->field('test')->not->valid(
        fn ($field, $input, $param, $value) => true,
        'Costume error - {field}'
    );

    expect($validation->is_valid())->toBeFalse();
    expect($validation->errors->all())->toMatchArray([
        'test' => 'Not, Costume error - Test',
    ]);
})->skip(true);
