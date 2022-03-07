<?php

use Validator\Rule\Valid;

it('can combine valid class with other valid class', function () {
    $valid = new Valid();
    $valid->required();

    $valid2 =new Valid();
    $valid2->alpha();
    $valid2->combine($valid);

    expect($valid2->get_validation())->toEqual('alpha|required');
});
