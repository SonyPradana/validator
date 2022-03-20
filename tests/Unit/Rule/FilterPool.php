<?php

use Validator\Rule\FilterPool;

it('can add filter pool using __get', function () {
    $pool =  new FilterPool();

    $pool->test->trim();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can add filter pool using __get with exits rule', function () {
    $pool =  new FilterPool();

    $pool->test->trim();
    $pool->test->upper_case();

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim|upper_case',
    ]);
});

it('can add filter pool using __set', function () {
    $pool =  new FilterPool();

    $pool->test = 'trim';

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim',
    ]);
});

it('can add filter pool using __set with exits rule', function () {
    $pool =  new FilterPool();

    $pool->test = 'trim';
    $pool->test = 'upper_case';

    expect($pool->get_pool())->toMatchArray([
        'test' => 'trim|upper_case',
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

it('can add filter pool using __invoke with exist rule', function () {
    $pool =  new FilterPool();

    $pool('test', 'test2')->trim();
    $pool('test')->upper_case();
    $pool('test2')->upper_case();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'trim|upper_case',
        'test2' => 'trim|upper_case',
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

it('can add filter pool using rule (multy) with rule exist', function () {
    $pool = new FilterPool();

    $pool->rule('test', 'test2')->trim();
    $pool->rule('test')->upper_case();
    $pool->rule('test2')->upper_case();

    expect($pool->get_pool())->toMatchArray([
        'test'  => 'trim|upper_case',
        'test2' => 'trim|upper_case',
    ]);
});
