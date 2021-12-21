<?php

it('can render min_len validation', function () {
    expect(vr()->min_len(240))
        ->toEqual('min_len,240')
    ;
});

it('can render invert min_len validation', function () {
    expect(vr()->not()->min_len(240))
        ->toEqual('invert_min_len,240')
    ;
});
