<?php

use Validator\Rule\Valid;

it('success render validation string', function () {
    expect(vr()->required())
        ->toEqual('required');

    expect(vr()->contains('one', 'two'))
        ->toEqual('contains,one;two');

    expect(vr()->boolean())
        ->toEqual('boolean,strict');

    expect(vr()->max_len(240))
        ->toEqual('max_len,240');

    expect(vr()->min_len(240))
        ->toEqual('min_len,240');

    expect(vr()->exact_len(240))
        ->toEqual('exact_len,240');

    expect(vr()->between_len(3, 11))
        ->toEqual('between_len,3;11');

    expect(vr()->alpha())
        ->toEqual('alpha');

    expect(vr()->alpha_numeric())
        ->toEqual('alpha_numeric');

    expect(vr()->alpha_dash())
        ->toEqual('alpha_dash');

    expect(vr()->alpha_numeric_dash())
        ->toEqual('alpha_numeric_dash');

    expect(vr()->alpha_numeric_space())
        ->toEqual('alpha_numeric_space');

    expect(vr()->alpha_space())
        ->toEqual('alpha_space');

    expect(vr()->numeric())
        ->toEqual('numeric');

    expect(vr()->integer())
        ->toEqual('integer');

    expect(vr()->float())
        ->toEqual('float');

    expect(vr()->valid_url())
        ->toEqual('valid_url');

    expect(vr()->url_exists())
        ->toEqual('url_exists');

    expect(vr()->valid_ip())
        ->toEqual('valid_ip');

    expect(vr()->valid_ipv4())
        ->toEqual('valid_ipv4');

    expect(vr()->valid_ipv6())
        ->toEqual('valid_ipv6');

    expect(vr()->valid_cc())
        ->toEqual('valid_cc');

    expect(vr()->valid_name())
        ->toEqual('valid_name');

    expect(vr()->street_address())
        ->toEqual('street_address');

    expect(vr()->iban())
        ->toEqual('iban');

    expect(vr()->date('31/12/1999'))
        ->toEqual('date,31/12/1999');

    expect(vr()->min_age(18))
        ->toEqual('min_age,18');

    expect(vr()->max_numeric(50))
        ->toEqual('max_numeric,50');

    expect(vr()->starts('Z'))
        ->toEqual('starts,Z');

    expect(vr()->required_file())
        ->toEqual('required_file');

    expect(vr()->extension('png', 'jpg', 'gif'))
        ->toEqual('extension,png;jpg;gif');

    expect(vr()->equalsfield('other_field_name'))
        ->toEqual('equalsfield,other_field_name');

    expect(vr()->guidv4())
        ->toEqual('guidv4');

    expect(vr()->phone_number())
        ->toEqual('phone_number');

    expect(vr()->regex('/test-[0-9]{3}/'))
        ->toEqual('regex,/test-[0-9]{3}/');

    expect(vr()->valid_json_string())
        ->toEqual('valid_json_string');

    expect(vr()->valid_array_size_greater(1))
        ->toEqual('valid_array_size_greater,1');

    expect(vr()->valid_array_size_lesser(1))
        ->toEqual('valid_array_size_lesser,1');

    expect(vr()->valid_array_size_equal(1))
        ->toEqual('valid_array_size_equal,1');

    expect(vr()->valid_twitter())
    ->toEqual('valid_twitter');
});

it('success render validation string using chain method', function () {
    $rule = new Valid();

    $rule
        ->required()
        ->contains('one', 'two')
        ->boolean()
        ->max_len(240)
        ->min_len(240)
        ->exact_len(240)
        ->between_len(3, 11)
        ->alpha()
        ->alpha_numeric()
        ->alpha_dash()
        ->alpha_numeric_dash()
        ->alpha_numeric_space()
        ->alpha_space()
        ->numeric()
        ->integer()
        ->float()
        ->valid_url()
        ->url_exists()
        ->valid_ip()
        ->valid_ipv4()
        ->valid_ipv6()
        ->valid_cc()
        ->valid_name()
        ->street_address()
        ->iban()
        ->date('31/12/1999')
        ->min_age(18)
        ->max_numeric(50)
        ->starts('Z')
        ->required_file()
        ->extension('png', 'jpg', 'gif')
        ->equalsfield('other_field_name')
        ->guidv4()
        ->phone_number()
        ->regex('/test-[0-9]{3}/')
        ->valid_json_string()
        ->valid_array_size_greater(1)
        ->valid_array_size_lesser(1)
        ->valid_array_size_equal(1)
        ->valid_twitter()
    ;

    expect($rule)
        ->toEqual('required|contains,one;two|boolean,strict|max_len,240|min_len,240|exact_len,240|between_len,3;11|alpha|alpha_numeric|alpha_dash|alpha_numeric_dash|alpha_numeric_space|alpha_space|numeric|integer|float|valid_url|url_exists|valid_ip|valid_ipv4|valid_ipv6|valid_cc|valid_name|street_address|iban|date,31/12/1999|min_age,18|max_numeric,50|starts,Z|required_file|extension,png;jpg;gif|equalsfield,other_field_name|guidv4|phone_number|regex,/test-[0-9]{3}/|valid_json_string|valid_array_size_greater,1|valid_array_size_lesser,1|valid_array_size_equal,1|valid_twitter')
    ;
});

it('success render invert validation string', function () {
    expect(vr()->not()->required())
        ->toEqual('invert_required');

    expect(vr()->not()->contains('one', 'two'))
        ->toEqual('invert_contains,one;two');

    expect(vr()->not()->boolean())
        ->toEqual('invert_boolean,strict');

    expect(vr()->not()->max_len(240))
        ->toEqual('invert_max_len,240');

    expect(vr()->not()->min_len(240))
        ->toEqual('invert_min_len,240');

    expect(vr()->not()->exact_len(240))
        ->toEqual('invert_exact_len,240');

    expect(vr()->not()->between_len(3, 11))
        ->toEqual('invert_between_len,3;11');

    expect(vr()->not()->alpha())
        ->toEqual('invert_alpha');

    expect(vr()->not()->alpha_numeric())
        ->toEqual('invert_alpha_numeric');

    expect(vr()->not()->alpha_dash())
        ->toEqual('invert_alpha_dash');

    expect(vr()->not()->alpha_numeric_dash())
        ->toEqual('invert_alpha_numeric_dash');

    expect(vr()->not()->alpha_numeric_space())
        ->toEqual('invert_alpha_numeric_space');

    expect(vr()->not()->alpha_space())
        ->toEqual('invert_alpha_space');

    expect(vr()->not()->numeric())
        ->toEqual('invert_numeric');

    expect(vr()->not()->integer())
        ->toEqual('invert_integer');

    expect(vr()->not()->float())
        ->toEqual('invert_float');

    expect(vr()->not()->valid_url())
        ->toEqual('invert_valid_url');

    expect(vr()->not()->url_exists())
        ->toEqual('invert_url_exists');

    expect(vr()->not()->valid_ip())
        ->toEqual('invert_valid_ip');

    expect(vr()->not()->valid_ipv4())
        ->toEqual('invert_valid_ipv4');

    expect(vr()->not()->valid_ipv6())
        ->toEqual('invert_valid_ipv6');

    expect(vr()->not()->valid_cc())
        ->toEqual('invert_valid_cc');

    expect(vr()->not()->valid_name())
        ->toEqual('invert_valid_name');

    expect(vr()->not()->street_address())
        ->toEqual('invert_street_address');

    expect(vr()->not()->iban())
        ->toEqual('invert_iban');

    expect(vr()->not()->date('31/12/1999'))
        ->toEqual('invert_date,31/12/1999');

    expect(vr()->not()->min_age(18))
        ->toEqual('invert_min_age,18');

    expect(vr()->not()->max_numeric(50))
        ->toEqual('invert_max_numeric,50');

    expect(vr()->not()->starts('Z'))
        ->toEqual('invert_starts,Z');

    expect(vr()->not()->required_file())
        ->toEqual('invert_required_file');

    expect(vr()->not()->extension('png', 'jpg', 'gif'))
        ->toEqual('invert_extension,png;jpg;gif');

    expect(vr()->not()->equalsfield('other_field_name'))
        ->toEqual('invert_equalsfield,other_field_name');

    expect(vr()->not()->guidv4())
        ->toEqual('invert_guidv4');

    expect(vr()->not()->phone_number())
        ->toEqual('invert_phone_number');

    expect(vr()->not()->regex('/test-[0-9]{3}/'))
        ->toEqual('invert_regex,/test-[0-9]{3}/');

    expect(vr()->not()->valid_json_string())
        ->toEqual('invert_valid_json_string');

    expect(vr()->not()->valid_array_size_greater(1))
        ->toEqual('invert_valid_array_size_greater,1');

    expect(vr()->not()->valid_array_size_lesser(1))
        ->toEqual('invert_valid_array_size_lesser,1');

    expect(vr()->not()->valid_array_size_equal(1))
        ->toEqual('invert_valid_array_size_equal,1');

    expect(vr()->not()->valid_twitter())
    ->toEqual('invert_valid_twitter');
});

it('success render invert validation string using chain method', function () {
    $rule = new Valid();

    $rule
        ->not()->required()
        ->not()->contains('one', 'two')
        ->not()->boolean()
        ->not()->max_len(240)
        ->not()->min_len(240)
        ->not()->exact_len(240)
        ->not()->between_len(3, 11)
        ->not()->alpha()
        ->not()->alpha_numeric()
        ->not()->alpha_dash()
        ->not()->alpha_numeric_dash()
        ->not()->alpha_numeric_space()
        ->not()->alpha_space()
        ->not()->numeric()
        ->not()->integer()
        ->not()->float()
        ->not()->valid_url()
        ->not()->url_exists()
        ->not()->valid_ip()
        ->not()->valid_ipv4()
        ->not()->valid_ipv6()
        ->not()->valid_cc()
        ->not()->valid_name()
        ->not()->street_address()
        ->not()->iban()
        ->not()->date('31/12/1999')
        ->not()->min_age(18)
        ->not()->max_numeric(50)
        ->not()->starts('Z')
        ->not()->required_file()
        ->not()->extension('png', 'jpg', 'gif')
        ->not()->equalsfield('other_field_name')
        ->not()->guidv4()
        ->not()->phone_number()
        ->not()->regex('/test-[0-9]{3}/')
        ->not()->valid_json_string()
        ->not()->valid_array_size_greater(1)
        ->not()->valid_array_size_lesser(1)
        ->not()->valid_array_size_equal(1)
        ->not()->valid_twitter()
    ;

    expect($rule)
        ->toEqual('invert_required|invert_contains,one;two|invert_boolean,strict|invert_max_len,240|invert_min_len,240|invert_exact_len,240|invert_between_len,3;11|invert_alpha|invert_alpha_numeric|invert_alpha_dash|invert_alpha_numeric_dash|invert_alpha_numeric_space|invert_alpha_space|invert_numeric|invert_integer|invert_float|invert_valid_url|invert_url_exists|invert_valid_ip|invert_valid_ipv4|invert_valid_ipv6|invert_valid_cc|invert_valid_name|invert_street_address|invert_iban|invert_date,31/12/1999|invert_min_age,18|invert_max_numeric,50|invert_starts,Z|invert_required_file|invert_extension,png;jpg;gif|invert_equalsfield,other_field_name|invert_guidv4|invert_phone_number|invert_regex,/test-[0-9]{3}/|invert_valid_json_string|invert_valid_array_size_greater,1|invert_valid_array_size_lesser,1|invert_valid_array_size_equal,1|invert_valid_twitter')
    ;
});
