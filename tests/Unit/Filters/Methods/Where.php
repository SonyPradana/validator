<?php

use Validator\Validator;

it('can render filer rule using method where (true)', function () {
    expect(fr()->trim()->where(fn () => true))->toEqual('trim');
});

it('can render filter rule using method where (false)', function () {
    expect(fr()->trim()->where(fn () => false))->toEqual('');
});

it('can reset filter rule using method where (true)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->trim()->where(fn () => true);

    expect($val->filter_out())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can reset filter rule using method where (false)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->trim()->where(fn () => false);

    expect($val->filter_out())->toMatchArray([
        'test' => ' trim ',
    ]);
});

it('can reset filter rule using method where (no return)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->trim()->where(function () {
        // no return
    });
})->throws('Condition closure not return boolean');

it('can reset filter rule using method where (no boolean)', function () {
    $val = new Validator(['test' => ' trim ']);

    $val->filter('test')->trim()->where(fn () => 'test');
})->throws('Condition closure not return boolean');
