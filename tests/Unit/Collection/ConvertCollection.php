<?php

use Validator\Collection;

it('can convert to array', function () {
    $array = ['key' => 'item'];

    expect(Collection::make($array))
        ->all()->toEqual($array);
});
