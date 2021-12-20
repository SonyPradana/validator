<?php

use Validator\Rule\ValidPool;
use Validator\Validator;

it("validate using fields and validation", function() {
    $input = [
        'id' => 1,
        'user'  => 'teguh',
        'name' => 'teguh agus',
        'favorite'   => ['manggo', 'durian', 'start fruite']
    ];
    $val = new Validator($input);

    $val->id->required()->integer();
    $val->field('user')->required()->min_len(5);
    $val('name')->required()->valid_name();

    expect($val->is_valid())->toBeTrue();
});

it("run validation condtion with valid condition", function() {
    $input = [
        'id' => 1,
        'user'  => 'teguh',
        'name' => 'teguh agus',
        'favorite'   => ['manggo', 'durian', 'start fruite']
    ];
    $val = new Validator($input);

    $val->id->required()->integer();
    $val->field('user')->required()->min_len(5);
    $val('name')->required()->valid_name();

    $val->if_valid(function() use ($val){
        expect($val->is_valid())->toBeTrue();
    })->else(function($err) {
        // its mean have no error
        expect($err)->toHaveCount(0);
    });

});

it("run validation condtion with valid failed condition", function() {
    $input = [
        'id' => null,
        'user'  => 'tgh',
        'name' => 'teguh agus',
        'favorite'   => ['manggo', 'durian', 'start fruite']
    ];
    $val = new Validator($input);

    $val->id->required()->integer();
    $val->field('user')->required()->min_len(5);
    $val('name')->required()->valid_name();

    $val->if_valid(function() {
        // skip, invalid validation
        expect(false)->toBeTrue();
    })->else(function($err) use ($val) {
        expect($val->is_valid())->toBeFalse();
    });

});

it('can validate nesting array', function () {
    $test = new Validator([
        'name' => 'angger',
        'nest' => [
            'number' => 12,
            'string' => 'a string',
        ],
        'users' => [
            ['name' => 'ulfa', 'age' => 21],
            ['name' => 'haikal', 'age' => 1],
        ],
    ]);

    $valid = $test->is_valid(function (ValidPool $valid) {
        $valid('name')->required()->max_len(7);
        $valid('nest.number')->required();
        $valid('users.*.name')->required();
    });

    expect($valid)->toBeTrue();
});

it('can validate invert nesting array', function () {
    $test = new Validator([
        // 'name' => 'angger',
        'hoby' => 'plaing,game',
        'nest' => [
            'number' => 12,
            'string' => 'a string',
        ],
        'users' => [
            ['name' => 'ulfa', 'age' => 21],
            ['name' => 'haikal', 'age' => 1],
        ],
    ]);

    $valid = $test->is_valid(function (ValidPool $valid) {
        $valid('name')->not()->required();
        $valid('hoby')->not()->contains();
        $valid('nest.number')->required();
        $valid('users.*.name')->required();
    });

    expect($valid)->toBeTrue();
});
