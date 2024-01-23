<?php

it('can rander rmpunctuation', function () {
    expect(fr()->rmpunctuation())
        ->toEqual('rmpunctuation')
    ;
});

it('can filter rmpunctuation', function () {
    $fr = new Validator\Validator(['field' => 'is true?']);

    $fr->filter('field')->rmpunctuation();

    expect($fr->filter_out())
        ->toEqual(['field' => 'is true'])
    ;
});
