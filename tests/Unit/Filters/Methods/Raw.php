<?php

use Validator\Validator;

it('can add filter rule using raw', function () {
    $validation = new Validator([
        'test' => 'test',
    ]);

    $validation->filter('test')->raw('upper_case');

    expect($validation->filters->get('test'))->toEqual('TEST');
});

it('can add filter rule using raw combine with other', function () {
    $validation = new Validator([
        'test' => ' test ',
    ]);

    $validation->filter('test')->raw('upper_case')->trim();

    expect($validation->filters->get('test'))->toEqual('TEST');
});
