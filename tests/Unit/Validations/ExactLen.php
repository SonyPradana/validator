<?php

it('can render exact_len validation', function () {
    expect(vr()->exact_len(240))
        ->toEqual('exact_len,240')
    ;
});

it('can render invert exact_len validation', function () {
    expect(vr()->not()->exact_len(240))
        ->toEqual('invert_exact_len,240')
    ;
});
