<?php

it('can render url_exists validation', function () {
    expect(vr()->url_exists())
        ->toEqual('url_exists')
    ;
});

it('can render invert url_exists validation', function () {
    expect(vr()->not()->url_exists())
        ->toEqual('invert_url_exists')
    ;
});
