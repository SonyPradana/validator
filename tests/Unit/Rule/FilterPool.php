<?php

use Validator\Rule\FilterPool;

it('can add filter pool using __get', function () {
    $pool =  new FilterPool();
    $pool->test->trim();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can add filter pool using __invoke', function () {
    $pool =  new FilterPool();
    $pool('test')->trim();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can add filter pool using __invoke (multy)', function () {
    $pool =  new FilterPool();
    $pool('test', 'test2')->trim();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'trim',
        'test2' => 'trim',
    ]);
});

it('can add filter pool using rule', function () {
    $pool =  new FilterPool();
    $pool->rule('test')->trim();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can add filter pool using rule (multy)', function () {
    $pool =  new FilterPool();
    $pool->rule('test', 'test2')->trim();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'trim',
        'test2' => 'trim',
    ]);
});
