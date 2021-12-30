<?php

it('can rander htmlencode', function () {
    expect(fr()->htmlencode())
        ->toEqual('htmlencode')
    ;
});

it('can filter htmlencode', function () {
    $fr = new \Validator\Validator(['field' => '<html>html tag</html>']);

    $fr->filter('field')->htmlencode();

    expect($fr->filter_out())
        ->toEqual(['field' => '&#60;html&#62;html tag&#60;/html&#62;'])
    ;
});
