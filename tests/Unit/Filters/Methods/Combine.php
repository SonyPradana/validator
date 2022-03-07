<?php

use Validator\Rule\Filter;

it('can combine filter class with other filter class', function () {
    $filter = new Filter();
    $filter->trim();

    $filter2 =new Filter();
    $filter2->lower_case();
    $filter2->combine($filter);

    expect($filter2->get_filter())->toEqual('lower_case|trim');
});
