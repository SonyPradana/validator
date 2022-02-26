<?php

use Validator\Validator;

it('can execute method using if (true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => true)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can execute method using if (false)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => false)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});

it('can execute method using if (true, true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => true)->trim()->if(fn () => true)->upper_case();

    expect($val->filter_out())->toMatchArray([
        'test' => 'TRIM',
    ]);
});

it('can execute method using if (true, false)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => true)->trim()->if(fn () => false)->upper_case();

    expect($val->filter_out())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can execute method using if (false, true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => false)->trim()->if(fn () => true)->upper_case();

    expect($val->filter_out())->toMatchArray([
        'test' => ' TRIM ',
    ]);
});

it('can execute method using if (false, false)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => false)->trim()->if(fn () => false)->upper_case();

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});

it('can execute method using if-contiune (true, true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => true)->if(fn () => true)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can execute method using if-contiune (true, false) x', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => true)->if(fn () => false)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});

it('can execute method using if-contiune (false, false)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => false)->if(fn () => false)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});

it('can execute method using if-contiune (false, true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => false)->if(fn () => true)->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can execute rule combine with submitted method', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->if(fn () => $val->submitted())->trim();

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});
