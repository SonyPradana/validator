<?php

use Validator\Rule\ValidPool;
use Validator\Validator;

it('can validate with normal behavior', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );

    expect($v->is_valid())->toBeFalse();
});

it('can filter valid rule with allowed field', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );

    $v->only(['test1', 'test2']);

    expect($v->is_valid())->toBeTrue();
});

it('can filter valid rule with allowed field (false)', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );
    $v->only(['test3']);

    expect($v->is_valid())->toBeFalse();
});

it('can filter valid rule with allowed field (but not exis)', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );

    $v->only(['test4']);

    expect($v->is_valid())->toBeTrue();
});

it('can filter valid rule with excepted field', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );

    $v->except(['test1', 'test2']);

    expect($v->is_valid())->toBeFalse();
});

it('can filter valid rule with excepted field (but not exis)', function () {
    $v = Validator::make(
        [
            'test1' => 'test',
            'test2' => 'test',
            'test3' => '',
        ],
        fn (ValidPool $v) => [
            $v('test1')->required(),
            $v('test2')->required(),
            $v('test3')->required(),
        ]
    );
    $v->except(['test4']);

    expect($v->is_valid())->toBeFalse();
});
