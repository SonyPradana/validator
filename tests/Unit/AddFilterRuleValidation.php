<?php

use Validator\Rule\FilterPool;
use Validator\Validator;

it('can add filter rule', function () {
    $validation = new Validator(['test' => 'test']);
    $validation->filter('test')->upper_case();

    expect($validation->filters)
        ->get('test')->toEqual('TEST');
});

it('can add filter rule using method filters (param)', function () {
    $valid = new Validator(['test' => ' test ', 'test2' => ' test ']);

    $valid->field('test', 'test2')->required();
    $valid->filters(fn (FilterPool $f) => [
        $f->test->trim(),
        $f->test2->trim(),
    ]);

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'test', 'test2' => 'test']
    );
});

it('can add filter rule using method filters (return)', function () {
    $valid = new Validator(['test' => ' test ', 'test2' => ' test ']);

    $valid->field('test', 'test2')->required();
    $valid->filters(function () {
        $f = new FilterPool();
        $f->test->trim();
        $f->test2->trim();

        return $f;
    });

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'test', 'test2' => 'test']
    );
});

it('can add new filter with exist rule', function () {
    $valid = new Validator(['test' => ' test ']);

    $valid->field('test')->required();

    $valid->filter('test')->trim();
    $valid->filter('test')->upper_case();

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'TEST']
    );
});

it('can add new filter with exist rule using method filters', function () {
    $valid = new Validator(['test' => ' test ']);

    $valid->field('test')->required();

    $valid->filters(fn (FilterPool $filter) => [
        $filter('test')->trim(),
        $filter('test')->upper_case(),
    ]);

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'TEST']
    );
});

// Multy ------------------------------------------------

it('can add multy filter using method filter', function () {
    $valid = new Validator(['test' => ' test ', 'test2' => ' test ']);

    $valid->field('test', 'test2')->required();
    $valid->filter('test', 'test2')->trim();

    expect($valid->filter_out())->toMatchArray(
        ['test' => 'test', 'test2' => 'test']
    );
});
