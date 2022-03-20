<?php

use Validator\Rule\ValidPool;

it('can add valid using __get', function () {
    $pool = new ValidPool();

    // rule
    $pool->test->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using __get with exist rule', function () {
    $pool = new ValidPool();

    // rule
    $pool->test->required();
    $pool->test->alpha();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required|alpha',
    ]);
});

it('can add valid using __set', function () {
    $pool = new ValidPool();

    // rule
    $pool->test = 'required';

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using __set with exist rule', function () {
    $pool = new ValidPool();

    // rule
    $pool->test = 'required';
    $pool->test = 'alpha';

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required|alpha',
    ]);
});

it('can add valid using __invoke', function () {
    $pool = new ValidPool();

    // rule
    $pool('test')->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using __invoke with exist rule', function () {
    $pool = new ValidPool();

    // rule
    $pool('test')->required();
    $pool('test')->alpha();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required|alpha',
    ]);
});

it('can add valid using __invoke (multy)', function () {
    $pool = new ValidPool();

    // rule
    $pool('test', 'test2')->required();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'required',
        'test2' => 'required',
    ]);
});

it('can add valid using rule', function () {
    $pool = new ValidPool();

    // rule
    $pool->rule('test')->required();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required',
    ]);
});

it('can add valid using rule with exist rule', function () {
    $pool = new ValidPool();

    // rule
    $pool->rule('test')->required();
    $pool->rule('test')->alpha();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'required|alpha',
    ]);
});

it('can add valid using rule (multy)', function () {
    $pool = new ValidPool();

    // rule
    $pool->rule('test', 'test2')->required();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'required',
        'test2' => 'required',
    ]);
});
