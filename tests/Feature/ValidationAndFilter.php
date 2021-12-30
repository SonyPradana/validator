<?php

use Validator\Validator;

it('can validate and filter in oneline', function () {
    $input = [
        'id'         => 1,
        'user'       => ' teguh ',
        'name'       => 'teguh agus',
        'favorite'   => ['manggo', 'durian', 'start fruite'],
    ];
    $val = new Validator($input);

    // validate rule
    $val->id->required()->integer();
    $val->field('user')->required()->min_len(5);
    $val('name')->required()->valid_name();
    // filter rule
    $val->filter('user')->upper_case()->trim();

    expect($val->failedOrFilter())
        ->toEqual(
            [
                'id'         => 1,
                'user'       => 'TEGUH',
                'name'       => 'teguh agus',
                'favorite'   => ['manggo', 'durian', 'start fruite'],
            ]
        )
    ;
});
