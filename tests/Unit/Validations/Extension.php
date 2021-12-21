<?php

it('can render extension validation', function () {
    expect(vr()->extension('png', 'jpg', 'gif'))
        ->toEqual('extension,png;jpg;gif')
    ;
});

it('can render invert extension validation', function () {
    expect(vr()->not()->extension('png', 'jpg', 'gif'))
        ->toEqual('invert_extension,png;jpg;gif')
    ;
});
