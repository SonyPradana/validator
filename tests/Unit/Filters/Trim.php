<?php

it('can rander trim', function () {
    expect(fr()->trim())
        ->toEqual('trim')
    ;
});

it('can filter trim', function () {
    $fr = new Validator\Validator(['field' => '  nomore space  ']);

    $fr->filter('field')->trim();

    expect($fr->filter_out())
        ->toEqual(['field' => 'nomore space'])
    ;
});
