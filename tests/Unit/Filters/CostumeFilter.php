<?php

use Validator\Validator;

it('can add costume filter', function () {
    $validation = new Validator(['test' => 'test']);

    $validation->filter('test')->filter(fn ($value, $param = []) => 'ok ' . $value);

    expect($validation->filters->all())->toMatchArray([
        'test' => 'ok test',
    ]);
});

it('can add costume filter combine with other', function () {
    $validation = new Validator(['test' => 'test']);

    $validation->filter('test')
        ->filter(fn ($value, $param = []) => 'ok ' . $value)
        ->upper_case();

    expect($validation->filters->all())->toMatchArray([
        'test' => 'OK TEST',
    ]);
});
