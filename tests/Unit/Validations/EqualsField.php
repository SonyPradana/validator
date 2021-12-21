<?php

it('can render equals_field validation', function () {
    expect(vr()->equals_field('other_field_name'))
        ->toEqual('equalsfield,other_field_name')
    ;
});

it('can render invert equals_field validation', function () {
    expect(vr()->not()->equals_field('other_field_name'))
        ->toEqual('invert_equalsfield,other_field_name')
    ;
});
