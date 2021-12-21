<?php

it('can render valid_url validation', function () {
    expect(vr()->valid_url())
        ->toEqual('valid_url')
    ;
});

it('can render invert valid_url validation', function () {
    expect(vr()->not()->valid_url())
        ->toEqual('invert_valid_url')
    ;
});
