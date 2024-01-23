<?php

it('can rander boolean', function () {
    expect(fr()->boolean())
        ->toEqual('boolean')
    ;
});

it('can filter boolean', function () {
    $fr = new Validator\Validator(
        [
            'field_1' => '1',
            'field_2' => 1,
            'field_3' => 'true',
            'field_4' => 'yes',
            'field_5' => 'on',
        ]
    );

    $fr->filter('field_1')->boolean();
    $fr->filter('field_2')->boolean();
    $fr->filter('field_3')->boolean();
    $fr->filter('field_4')->boolean();
    $fr->filter('field_5')->boolean();

    expect($fr->filter_out())
        ->toEqual(
            [
                'field_1' => true,
                'field_2' => true,
                'field_3' => true,
                'field_4' => true,
                'field_5' => true,
            ]
        )
    ;
});
