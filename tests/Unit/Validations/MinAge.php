<?php

it('can render min_age validation', function () {
    expect(vr()->min_age(18))
        ->toEqual('min_age,18')
    ;
});

it('can render invert min_age validation', function () {
    expect(vr()->not()->min_age(18))
        ->toEqual('invert_min_age,18')
    ;
});
