<?php

it('can render starts validation', function () {
    expect(vr()->starts('Z'))
        ->toEqual('starts,Z')
    ;
});

it('can render invert starts validation', function () {
    expect(vr()->not()->starts('Z'))
        ->toEqual('invert_starts,Z')
    ;
});
