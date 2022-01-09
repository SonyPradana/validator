<?php

use Validator\Rule\FilterPool;
use Validator\Rule\ValidPool;
use Validator\Validator;

// add field
it('can add field using constructor', function () {
    $fields = [
        'field_1' => 'field_1',
        'field_2' => 'field_3',
        'field_3' => 'field_3',
    ];

    $valid = new Validator($fields);
    expect($valid->get_fields())
        ->toEqual($fields)
    ;
});

it('can add field using method fields', function () {
    $fields = [
        'field_1' => 'field_1',
        'field_2' => 'field_3',
        'field_3' => 'field_3',
    ];

    $valid = new Validator();
    $valid->fields($fields);
    expect($valid->get_fields())
        ->toEqual($fields)
    ;
});

// add validation
it('can add validation using method field', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add validation using __get', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add validation using invoke', function () {
    $valid = new Validator(['test' => 'test']);

    $valid('test')->required();

    expect($valid->is_valid())->toBeTrue();
});

// run validation
it('can run validation using method is_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can run validation using method is_valid with closure (param)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
        'test6' => 'test',
        'test7' => 'test',
    ]);

    expect($valid->is_valid(function (ValidPool $pool) {
        $pool->rule('test1')->required();
        $pool('test2')->required();
        $pool->test3->required();
        $pool->rule('test4', 'test5')->required();
        $pool('test6', 'test7')->required();
    }))->toBeTrue();
});

it('can run validation using method is_valid with closure (return)', function () {
    $valid = new Validator([
        'test1' => 'test',
        'test2' => 'test',
        'test3' => 'test',
        'test4' => 'test',
        'test5' => 'test',
    ]);

    expect($valid->is_valid(function () {
        $pool = new ValidPool();
        $pool->rule('test1')->required();
        $pool('test2')->required();
        $pool->test3->required();
        $pool->rule('test4', 'test5')->required();

        return $pool;
    }))->toBeTrue();
});

it('can run validation using method if_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    $valid->if_valid(function () {
        expect(true)->toBeTrue();
    })->else(function ($err) {
        expect($err)->toBe([]);
    });
});

it('can run validation using method validOrException', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->validOrException())->toBeTrue();
});

it('can run validation using method validOrError', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->validOrError())->toBeTrue();
});

it('can run validation using method validOrError but not valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required()->min_len(5);

    expect($valid->validOrError())->toBeArray();
});

test('method is_error is invert as is_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->test->required();

    expect($valid->is_error())->toBeFalse();
    expect($valid->is_error())->not->toEqual($valid->is_valid());
});

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

// get error message
it('can get error message when valadation is fallen using method get_error', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    expect($valid->get_error())->toHaveCount(1);
});

it('can get error message when valadation is fallen using method if_valid', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    $valid->if_valid(function () {
        expect(true)->toBeTrue();
    })->else(function ($err) {
        expect($err)->toHaveCount(1);
    });
});

it('can get error message when valadation is fallen using method validOrError', function () {
    $valid = new Validator(['test' => 'test']);

    $valid->field('test')->min_len(5);

    expect($valid->validOrError())->toHaveCount(1);
});

// can add multi validate rule
it('can add multy field using method field', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid->field('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});

it('can add multy field using method __invoke', function () {
    $valid = new Validator(['test' => 'test', 'test2' => 'test']);

    $valid('test', 'test2')->required();

    expect($valid->is_valid())->toBeTrue();
});

// can add multi filter rule
it('can add multy filter using method filter', function () {
    $valid = new Validator(['test' => ' test ', 'test2' => ' test ']);

    $valid->field('test', 'test2')->required();
    $valid->filter('test', 'test2')->trim();

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'test', 'test2' => 'test']
    );
});
