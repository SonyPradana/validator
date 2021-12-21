<?php

it('can render between_len validation', function () {
    expect(vr()->between_len(3, 11))
        ->toEqual('between_len,3;11')
    ;
});

it('can render invert between_len validation', function () {
    expect(vr()->not()->between_len(3, 11))
        ->toEqual('invert_between_len,3;11')
    ;
});
