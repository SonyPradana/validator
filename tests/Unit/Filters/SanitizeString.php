<?php

it('can rander sanitize_string', function () {
    expect(fr()->sanitize_string())
        ->toEqual('sanitize_string')
    ;
});

it('can filter sanitize_string', function () {
    $fr = new \Validator\Validator(['field' => '<h1>Hello World!</h1>']);

    $fr->filter('field')->sanitize_string();

    expect($fr->filter_out())
        ->toEqual(['field' => 'Hello World!'])
    ;
});
