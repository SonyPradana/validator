<?php

it('can rander slug', function () {
    expect(fr()->slug())
        ->toEqual('slug')
    ;
});

it('can filter slug', function () {
    $fr = new \Validator\Validator(['field' => 'long title tobe url']);

    $fr->filter('field')->slug();

    expect($fr->filter_out())
        ->toEqual(['field' => 'long-title-tobe-url'])
    ;
});
