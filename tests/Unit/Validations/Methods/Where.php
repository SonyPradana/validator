<?php

use Validator\Validator;

it('can render validation rule using method where (true)', function () {
    expect(vr()->required()->where(fn () => true))->toEqual('required');
});

it('can render validation rule using method where (false)', function () {
    expect(vr()->required()->where(fn () => false))->toEqual('');
});

it('can reset validation rule using method where (true)', function () {
    $val = new Validator();

    // output: required
    $val->field('test')->required()->where(fn () => true);

    expect($val->is_valid())->toBeFalse();
});

it('can reset validation rule using method where (false)', function () {
    $val = new Validator();

    // output: ''
    $val->test->required()->where(fn () => false);

    expect($val->is_valid())->toBeTrue();
});

it('can reset validation rule using method where (no return)', function () {
    $val = new Validator();

    // output: ''
    $val->test->required()->where(function () {
        // empty function
    });
})->throws('Condition closure not return boolean');

it('can reset validation rule using method where (no boolean)', function () {
    $val = new Validator();

    // output: throw error
    $val->test->required()->where(fn () => 'test');
})->throws('Condition closure not return boolean');
