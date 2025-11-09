<?php

namespace App\Helpers;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class Phone
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /**
     * Format a phone number to the E.164 standard.
     *
     * This method attempts to parse and validate a given phone number
     * using the specified region. If the phone number is valid, it is
     * formatted to the E.164 standard. If parsing fails or the number
     * is invalid, the method returns null.
     *
     * @param  string  $phone  The phone number to format.
     * @param  string  $region  The region code to use for parsing. Defaults to 'NG' (Nigeria).
     * @param  string|null  $standard  The standard to return the phone number in. Defaults to E164.
     *
     * Format standards:
     * - default: PhoneNumberFormat::E164,
     * - international: PhoneNumberFormat::INTERNATIONAL,
     * - national: PhoneNumberFormat::NATIONAL,
     * - url: PhoneNumberFormat::RFC3966,
     * @return string|null The formatted phone number in E.164 standard, or null if invalid.
     */
    public static function format(string $phone, string $region = 'NG', string $standard = 'default'): ?string
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $numberProto = $phoneUtil->parse($phone, $region);

            if ($phoneUtil->isValidNumber($numberProto)) {
                return $phoneUtil->format($numberProto, [
                    'default' => PhoneNumberFormat::E164,
                    'international' => PhoneNumberFormat::INTERNATIONAL,
                    'national' => PhoneNumberFormat::NATIONAL,
                    'url' => PhoneNumberFormat::RFC3966,
                ][$standard] ?? PhoneNumberFormat::E164);
            }
        } catch (NumberParseException $e) {
            return null;
        }

        return null;
    }

    /**
     * Normalize a phone number to E.164 format.
     *
     * This method cleans the phone number by removing spaces, hyphens, and parentheses,
     * and then formats it to E.164 standard. If the phone number is invalid, it returns null.
     *
     * @param  string  $phone  The phone number to normalize.
     * @param  string  $country_code  The default country code to use if the phone number doesn't starts with '+'.
     * @return null|string The normalized phone number in E.164 format, or null if invalid.
     */
    public static function normalize(string $phone, string $country_code = 'NG'): ?string
    {
        // Remove spaces, hyphens, parentheses
        return self::format(self::clean($phone), $country_code);
    }

    /**
     * Check if a phone number is valid.
     *
     * @param  string  $phone  The phone number to validate.
     * @return bool True if the phone number is valid, false otherwise.
     */
    public static function validate(string $phone): bool
    {
        return preg_match(self::pattern(), $phone);
    }

    /**
     * Get the regex pattern for validating phone numbers.
     *
     * @return string The regex pattern for phone numbers.
     */
    public static function pattern(): string
    {
        // E.164 international: +<country_code><subscriber_number> => 8–15 digits total (no + in count)
        // Local starting with 0: 8–15 digits
        return '/^(?:\+[1-9]\d{7,14}|0\d{7,14})$/';
    }

    /**
     * Clean a phone number by removing all non-numeric characters,
     * and replace leading multiple zeros (e.g. 008...) with a single zero.
     *
     * @param  string  $phone  The phone number to clean.
     * @param  bool  $strict  If true, remove all non-digits; otherwise, remove spaces, hyphens, parentheses.
     * @return string The cleaned phone number containing only digits, with leading zeros normalized.
     */
    public static function clean(string $phone, bool $strict = false): string
    {
        $cleaned = preg_replace($strict ? '/\D/' : '/[\s\-()]/', '', trim($phone));

        // Replace leading multiple zeros with a single zero
        $cleaned = preg_replace('/^0+/', '0', $cleaned);

        return $cleaned;
    }
}
