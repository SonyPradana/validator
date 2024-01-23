<?php

it('can rander lower_case', function () {
    expect(fr()->lower_case())
        ->toEqual('lower_case')
    ;
});

it('can filter lower_case', function () {
    $fr = new Validator\Validator(['field' => 'TEST']);

    $fr->filter('field')->lower_case();

    expect($fr->filter_out())
        ->toEqual(['field' => 'test'])
    ;
});
