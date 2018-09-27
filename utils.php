<?php

/**
 * @see https://stackoverflow.com/a/834355/5423625
 */
function str_starts_with($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

/**
 * @see https://stackoverflow.com/a/834355/5423625
 */
function str_ends_with($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
