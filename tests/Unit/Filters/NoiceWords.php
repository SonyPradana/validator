<?php

it('can rander noise_words', function () {
    expect(fr()->noise_words())
        ->toEqual('noise_words')
    ;
});

it('can filter noice_words', function () {
    $fr = new \Validator\Validator(['field' => 'word']);

    $fr->filter('field')->noise_words();

    expect($fr->filter_out())
        ->toEqual(['field' => 'word'])
    ;
});
