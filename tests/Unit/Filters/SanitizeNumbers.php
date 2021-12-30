<?php

it('can rander sanitize_numbers', function () {
    expect(fr()->sanitize_numbers())
        ->toEqual('sanitize_numbers')
    ;
});

it('can filter sanitize_numbers', function () {
    $fr = new \Validator\Validator(['field' => '5-2+3pp']);

    $fr->filter('field')->sanitize_numbers();

    expect($fr->filter_out())
        ->toEqual(['field' => '5-2+3'])
    ;
});
