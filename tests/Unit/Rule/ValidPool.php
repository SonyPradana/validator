<?php

use Validator\Rule\ValidPool;

it('can add valid using __get', function () {
    $pool = new ValidPool();
    $pool->test->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using __invoke', function () {
    $pool = new ValidPool();
    $pool('test')->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using __invoke (multy)', function () {
    $pool = new ValidPool();
    $pool('test', 'test2')->required();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'required',
        'test2' => 'required',
    ]);
});

it('can add valid using rule', function () {
    $pool = new ValidPool();
    $pool->rule('test')->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using rule (multy)', function () {
    $pool = new ValidPool();
    $pool->rule('test', 'test2')->required();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'required',
        'test2' => 'required',
    ]);
});
