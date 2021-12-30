<?php

it('can rander sanitize_floats', function () {
    expect(fr()->sanitize_floats())
        ->toEqual('sanitize_floats')
    ;
});

it('can filter sanitize_floats', function () {
    $fr = new \Validator\Validator(['field' => '12.3']);

    $fr->filter('field')->sanitize_floats();

    expect($fr->filter_out())
        ->toEqual(['field' => 12.3])
    ;
});
