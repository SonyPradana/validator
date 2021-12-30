<?php

it('can rander whole_number', function () {
    expect(fr()->whole_number())
        ->toEqual('whole_number')
    ;
});

it('can filter whole_number', function () {
    $fr = new \Validator\Validator(['field' => '123']);

    $fr->filter('field')->whole_number();

    expect($fr->filter_out())
        ->toEqual(['field' => 123])
    ;
});
