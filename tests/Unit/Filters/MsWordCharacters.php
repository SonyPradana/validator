<?php

it('can rander ms_word_characters', function () {
    expect(fr()->ms_word_characters())
        ->toEqual('ms_word_characters')
    ;
});

it('can filter ms_word_characters', function () {
    $fr = new \Validator\Validator(['field' => '“test”,‘test’,–,…']);

    $fr->filter('field')->ms_word_characters();

    expect($fr->filter_out())
        ->toEqual(['field' => '"test",\'test\',-,...'])
    ;
});
