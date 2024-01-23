<?php

it('can rander basic_tags', function () {
    expect(fr()->basic_tags())
        ->toEqual('basic_tags')
    ;
});

it('can filter basic_tags', function () {
    $fr = new Validator\Validator(['field' => '<script>link</script>']);

    $fr->filter('field')->basic_tags();

    expect($fr->filter_out())
        ->toEqual(['field' => 'link'])
    ;
});
