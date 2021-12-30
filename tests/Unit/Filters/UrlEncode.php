<?php

it('can rander urlencode', function () {
    expect(fr()->urlencode())
        ->toEqual('urlencode')
    ;
});

it('can filter urlencode', function () {
    $fr = new \Validator\Validator(['field' => 'test.com/true/right?one=1#2']);

    $fr->filter('field')->urlencode();

    expect($fr->filter_out())
        ->toEqual(['field' => 'test.com%2Ftrue%2Fright%3Fone%3D1%232'])
    ;
});
