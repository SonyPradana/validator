<?php

it('can render max_len validation', function () {
    expect(vr()->max_len(240))
        ->toEqual('max_len,240')
    ;
});

it('can render invert max_len validation', function () {
    expect(vr()->not()->max_len(240))
        ->toEqual('invert_max_len,240')
    ;
});
