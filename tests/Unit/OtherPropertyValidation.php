<?php
use Validator\Validator;

// other property
it('property \'not\' same result with method \'not()\'', function () {
    $val = new Validator();

    $val->field('test')->not->required();
    $val->test2->not->required();

    expect($val->is_valid())->toBeTrue();
});
