<?php

use Validator\Rule\FilterPool;
use Validator\Validator;

// run filter
it('can run filter using method filter_out', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => 'test',
    ]);

    $valid->filter('test1')->upper_case();

    expect($valid->filter_out())
        ->toEqual([
            'test1' => 'TEST',
            'test2' => 'test',
        ])
    ;
});

it('can run filter using method filter_out without filter rules', function () {
    $field = [
        'test1' => 'test',
        'test2' => 'test',
        'files' => [
            'test' => [
                'name'  => 'test',
                'error' => 4,
            ],
        ],
    ];

    $valid = new Validator($field);

    expect($valid->filter_out())->toEqual($field)
    ;
});

it('can run filter using method filter_out with closure (param)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => ' test ',
        'test3' => 'TEST',
        'test4' => ' test ',
        'test5' => ' test ',
        'test6' => ' test ',
        'test7' => ' test ',
    ]);

    expect(
        $valid->filter_out(function (FilterPool $pool) {
            $pool->rule('test1')->upper_case();
            $pool->test2->trim();
            $pool('test3')->lower_case();
            $pool->rule('test4', 'test5')->trim();
            $pool('test6', 'test7')->trim();
        })
    )->toEqual([
        'test1' => 'TEST',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
        'test6' => 'test',
        'test7' => 'test',
    ]);
});

it('can run filter using method filter_out with closure (return)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => ' test ',
        'test3' => 'TEST',
        'test4' => ' test ',
        'test5' => ' test ',
        'test6' => ' test ',
        'test7' => ' test ',
    ]);

    expect(
        $valid->filter_out(function () {
            $pool = new FilterPool();
            $pool->rule('test1')->upper_case();
            $pool->test2->trim();
            $pool('test3')->lower_case();
            $pool->rule('test4', 'test5')->trim();
            $pool('test6', 'test7')->trim();

            return $pool;
        })
    )->toEqual([
        'test1' => 'TEST',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
        'test6' => 'test',
        'test7' => 'test',
    ]);
});

it('can run filter using method failedOrFilter', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->required();
    $valid->filter('test')->upper_case();

    expect($valid->failedOrFilter())
        ->toEqual(['test' => 'TEST'])
    ;
});

it('can run filter using method failedOrFilter but not valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);
    $valid->filter('test')->upper_case();

    expect($valid->failedOrFilter())->toBeTrue();
});

it('can get filter_out using filters propterty', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->filter('test')->upper_case();

    expect($valid->filters)
        ->has('test')->toBeTrue()
        ->get('test')->toEqual('TEST')
    ;
});
