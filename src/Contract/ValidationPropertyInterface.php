<?php

declare(strict_types=1);

namespace Validator\Contract;

/**
 * Doest containt anythink,
 * just load property doc.
 *
 * @property string $required
 * @property string $valid_email
 * @property string $max_len
 * @property string $min_len
 * @property string $exact_len
 * @property string $between_len
 * @property string $alpha
 * @property string $alpha_numeric
 * @property string $alpha_numeric_space
 * @property string $alpha_numeric_dash
 * @property string $alpha_dash
 * @property string $alpha_space
 * @property string $numeric
 * @property string $integer
 * @property string $boolean
 * @property string $float
 * @property string $valid_url
 * @property string $url_exists
 * @property string $valid_ip
 * @property string $valid_ipv4
 * @property string $valid_ipv6
 * @property string $guidv4
 * @property string $valid_cc
 * @property string $valid_name
 * @property string $contains
 * @property string $contains_list
 * @property string $doesnt_contain_list
 * @property string $street_address
 * @property string $date
 * @property string $min_numeric
 * @property string $max_numeric
 * @property string $min_age
 * @property string $invalid
 * @property string $starts
 * @property string $extension
 * @property string $required_file
 * @property string $equalsfield
 * @property string $iban
 * @property string $phone_number
 * @property string $regex
 * @property string $valid_json_string
 * @property string $valid_array_size_greater
 * @property string $valid_array_size_lesser
 * @property string $valid_array_size_equal
 * @property string $valid_twitter
 */
interface ValidationPropertyInterface
{
}
