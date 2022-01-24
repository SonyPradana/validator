<?php

use Validator\Validator;

it('can execute method using if (true)', function () {
    $val = new Validator();

    // output: required
    $val->field('test')->if(fn () => true)->required();

    expect($val->is_valid())->toBeFalse();
});

it('can execute method using if (false)', function () {
    $val = new Validator();

    // output: required
    $val->field('test')->if(fn () => false)->required();

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if (true, true)', function () {
    $val = new Validator(['test' => '200']);

    // output: numeric|min_len,2
    $val->field('test')->if(fn () => true)->numeric()->if(fn () => true)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if (true, false)', function () {
    $val = new Validator(['test' => '1']);

    // output: numeric
    $val->field('test')->if(fn () => true)->numeric()->if(fn () => false)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if (false, true)', function () {
    $val = new Validator(['test' => 'test']);

    // output: min_len
    $val->field('test')->if(fn () => false)->numeric()->if(fn () => true)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if (false, false)', function () {
    $val = new Validator(['test' => 'text']);

    // output: ''
    $val->field('test')->if(fn () => false)->numeric()->if(fn () => false)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if-contiune (true, true)', function () {
    $val = new Validator(['test' => 'test']);

    // output: 'required'
    $val->field('test')->if(fn () => true)->if(fn () => true)->required();

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if-contiune (true, false) x', function () {
    $val = new Validator(['test' => 'text']);

    // output: ''
    $val->field('test')->if(fn () => true)->if(fn () => false)->alpha();

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if-contiune (false, false)', function () {
    $val = new Validator(['test' => 'text']);

    // output: ''
    $val->field('test')->if(fn () => false)->if(fn () => false)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can execute method using if-contiune (false, true)', function () {
    $val = new Validator(['test' => 'text']);

    // output: ''
    $val->field('test')->if(fn () => false)->if(fn () => true)->min_len(2);

    expect($val->is_valid())->toBeTrue();
});
