<?php
/**
 * @author      Fliew
 * @link        http://fliew.com
 * 
 * @package     Supercell
 * @version     2
 * @link        http://fliew.com/supercell
 * @link        http://github.com/Fliew/Supercell
 * @since       Supercell: Monday, June 08, 2008
 * @since       Supercell 2: Thursday, March 24, 2011
 * @copyright   Copyright (C) 2010 by Fliew. All rights reserved.
 * @license     GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category    FFormat
 */

class FFormat implements FFormatInterface
{
    /**
     * Formats a phone number
     * 
     * @access  public
     * @static
     * @param   integer $numbers
     * @return  mixed
     */
    public static function phone($numbers)
    {
        $amount =   strlen($numbers);
        
        // We can have:
        // 1-800-555-5555
        // 800-555-5555
        // 555-5555
        
        if ($amount == 11)
        {
            $number = $numbers[0] . '-' . substr($numbers, 1, 3) . '-' . substr($numbers, 4, 3) . '-' . substr($numbers, 7, 4);
            
            return $number;
        }
        
        if ($amount == 10)
        {
            $number = substr($numbers, 0, 3) . '-' . substr($numbers, 3, 3) . '-' . substr($numbers, 6, 4);
            
            return $number;
        }
        
        if ($amount == 7)
        {
            $number = substr($numbers, 0, 3) . '-' . substr($numbers, 1, 4);
            
            return $number;
        }
    }
    
    /**
     * Formats a link
     * 
     * @access  public
     * @static
     * @param   string  $url
     * @param   mixed   $www
     * @param   mixed   $trail_slash
     * @return  string
     */
    public static function url($url, $www = null, $trail_slash = null)
    {
        // Checking for http://
        if (preg_match('/^http\:\/\//', $url))
        {
            // Continue
        }
        else
        {
            // Adds it to the begining.
            $url = 'http://' . $url;
        }
        
        // Checking for www.
        if (isset($www))
        {
            // Ok it matters so do we want it or not?
            if ($www === true)
            {
                if (preg_match('/http\:\/\/www\./', $url))
                {
                    // It is found so we don't need to worry.
                }
                else
                {
                    // No, we need to add it.
                    $url = str_replace('http://', 'http://www.', $url);
                }
            }
            else if ($www === false)
            {
                if (preg_match('/http\:\/\/www\./', $url))
                {
                    // We don't want it
                    $url = str_replace('www.', '', $url);
                }
                else
                {
                    // It isn't there
                }
            }
        }
        
        if (isset($trail_slash))
        {
            if ($trail_slash === true)
            {
                if (preg_match('/\/$/', $url))
                {
                    // It is already there.
                }
                else
                {
                    $url = $url . '/';
                }
            }
            else if ($trail_slash === false)
            {
                if (preg_match('/\/$/', $url))
                {
                    // We don't want it
                    $url = preg_replace('/\/$/', '', $url);
                }
                else
                {
                    // It isn't there.
                }
            }
        }
        
        return $url;
    }
    
    /**
     * Chountry code to name
     * 
     * @access  public
     * @static
     * @param   string  $code
     * @return  string
     */
    public static function country($code)
    {
        $code_to_country = array(
            'AF'    =>  'Afghanistan',
            'AL'    =>  'Albania',
            'DZ'    =>  'Algeria',
            'AS'    =>  'American Samoa',
            'AD'    =>  'Andorra',
            'AO'    =>  'Angola',
            'AI'    =>  'Anguilla',
            'AQ'    =>  'Antarctica',
            'AG'    =>  'Antigua And Barbuda',
            'AR'    =>  'Argentina',
            'AM'    =>  'Armenia',
            'AW'    =>  'Aruba',
            'AU'    =>  'Australia',
            'AT'    =>  'Austria',
            'AZ'    =>  'Azerbaijan',
            'BS'    =>  'Bahamas',
            'BH'    =>  'Bahrain',
            'BD'    =>  'Bangladesh',
            'BB'    =>  'Barbados',
            'BY'    =>  'Belarus',
            'BE'    =>  'Belgium',
            'BZ'    =>  'Belize',
            'BJ'    =>  'Benin',
            'BM'    =>  'Bermuda',
            'BT'    =>  'Bhutan',
            'BO'    =>  'Bolivia',
            'BA'    =>  'Bosnia And Herzegovina',
            'BW'    =>  'Botswana',
            'BV'    =>  'Bouvet Island',
            'BR'    =>  'Brazil',
            'IO'    =>  'British Indian Ocean Territory',
            'BN'    =>  'Brunei',
            'BG'    =>  'Bulgaria',
            'BF'    =>  'Burkina Faso',
            'BI'    =>  'Burundi',
            'KH'    =>  'Cambodia',
            'CM'    =>  'Cameroon',
            'CA'    =>  'Canada',
            'CV'    =>  'Cape Verde',
            'KY'    =>  'Cayman Islands',
            'CF'    =>  'Central African Republic',
            'TD'    =>  'Chad',
            'CL'    =>  'Chile',
            'CN'    =>  'China',
            'CX'    =>  'Christmas Island',
            'CC'    =>  'Cocos (Keeling) Islands',
            'CO'    =>  'Columbia',
            'KM'    =>  'Comoros',
            'CG'    =>  'Congo',
            'CK'    =>  'Cook Islands',
            'CR'    =>  'Costa Rica',
            'CI'    =>  'Cote D\'Ivorie (Ivory Coast)',
            'HR'    =>  'Croatia (Hrvatska)',
            'CU'    =>  'Cuba',
            'CY'    =>  'Cyprus',
            'CZ'    =>  'Czech Republic',
            'CD'    =>  'Democratic Republic Of Congo (Zaire)',
            'DK'    =>  'Denmark',
            'DJ'    =>  'Djibouti',
            'DM'    =>  'Dominica',
            'DO'    =>  'Dominican Republic',
            'TP'    =>  'East Timor',
            'EC'    =>  'Ecuador',
            'EG'    =>  'Egypt',
            'SV'    =>  'El Salvador',
            'GQ'    =>  'Equatorial Guinea',
            'ER'    =>  'Eritrea',
            'EE'    =>  'Estonia',
            'ET'    =>  'Ethiopia',
            'FK'    =>  'Falkland Islands (Malvinas)',
            'FO'    =>  'Faroe Islands',
            'FJ'    =>  'Fiji',
            'FI'    =>  'Finland',
            'FR'    =>  'France',
            'FX'    =>  'France, Metropolitan',
            'GF'    =>  'French Guinea',
            'PF'    =>  'French Polynesia',
            'TF'    =>  'French Southern Territories',
            'GA'    =>  'Gabon',
            'GM'    =>  'Gambia',
            'GE'    =>  'Georgia',
            'DE'    =>  'Germany',
            'GH'    =>  'Ghana',
            'GI'    =>  'Gibraltar',
            'GR'    =>  'Greece',
            'GL'    =>  'Greenland',
            'GD'    =>  'Grenada',
            'GP'    =>  'Guadeloupe',
            'GU'    =>  'Guam',
            'GT'    =>  'Guatemala',
            'GN'    =>  'Guinea',
            'GW'    =>  'Guinea-Bissau',
            'GY'    =>  'Guyana',
            'HT'    =>  'Haiti',
            'HM'    =>  'Heard And McDonald Islands',
            'HN'    =>  'Honduras',
            'HK'    =>  'Hong Kong',
            'HU'    =>  'Hungary',
            'IS'    =>  'Iceland',
            'IN'    =>  'India',
            'ID'    =>  'Indonesia',
            'IR'    =>  'Iran',
            'IQ'    =>  'Iraq',
            'IE'    =>  'Ireland',
            'IL'    =>  'Israel',
            'IT'    =>  'Italy',
            'JM'    =>  'Jamaica',
            'JP'    =>  'Japan',
            'JO'    =>  'Jordan',
            'KZ'    =>  'Kazakhstan',
            'KE'    =>  'Kenya',
            'KI'    =>  'Kiribati',
            'KW'    =>  'Kuwait',
            'KG'    =>  'Kyrgyzstan',
            'LA'    =>  'Laos',
            'LV'    =>  'Latvia',
            'LB'    =>  'Lebanon',
            'LS'    =>  'Lesotho',
            'LR'    =>  'Liberia',
            'LY'    =>  'Libya',
            'LI'    =>  'Liechtenstein',
            'LT'    =>  'Lithuania',
            'LU'    =>  'Luxembourg',
            'MO'    =>  'Macau',
            'MK'    =>  'Macedonia',
            'MG'    =>  'Madagascar',
            'MW'    =>  'Malawi',
            'MY'    =>  'Malaysia',
            'MV'    =>  'Maldives',
            'ML'    =>  'Mali',
            'MT'    =>  'Malta',
            'MH'    =>  'Marshall Islands',
            'MQ'    =>  'Martinique',
            'MR'    =>  'Mauritania',
            'MU'    =>  'Mauritius',
            'YT'    =>  'Mayotte',
            'MX'    =>  'Mexico',
            'FM'    =>  'Micronesia',
            'MD'    =>  'Moldova',
            'MC'    =>  'Monaco',
            'MN'    =>  'Mongolia',
            'MS'    =>  'Montserrat',
            'MA'    =>  'Morocco',
            'MZ'    =>  'Mozambique',
            'MM'    =>  'Myanmar (Burma)',
            'NA'    =>  'Namibia',
            'NR'    =>  'Nauru',
            'NP'    =>  'Nepal',
            'NL'    =>  'Netherlands',
            'AN'    =>  'Netherlands Antilles',
            'NC'    =>  'New Caledonia',
            'NZ'    =>  'New Zealand',
            'NI'    =>  'Nicaragua',
            'NE'    =>  'Niger',
            'NG'    =>  'Nigeria',
            'NU'    =>  'Niue',
            'NF'    =>  'Norfolk Island',
            'KP'    =>  'North Korea',
            'MP'    =>  'Northern Mariana Islands',
            'NO'    =>  'Norway',
            'OM'    =>  'Oman',
            'PK'    =>  'Pakistan',
            'PW'    =>  'Palau',
            'PA'    =>  'Panama',
            'PG'    =>  'Papua New Guinea',
            'PY'    =>  'Paraguay',
            'PE'    =>  'Peru',
            'PH'    =>  'Philippines',
            'PN'    =>  'Pitcairn',
            'PL'    =>  'Poland',
            'PT'    =>  'Portugal',
            'PR'    =>  'Puerto Rico',
            'QA'    =>  'Qatar',
            'RE'    =>  'Reunion',
            'RO'    =>  'Romania',
            'RU'    =>  'Russia',
            'RW'    =>  'Rwanda',
            'SH'    =>  'Saint Helena',
            'KN'    =>  'Saint Kitts And Nevis',
            'LC'    =>  'Saint Lucia',
            'PM'    =>  'Saint Pierre And Miquelon',
            'VC'    =>  'Saint Vincent And The Grenadines',
            'SM'    =>  'San Marino',
            'ST'    =>  'Sao Tome And Principe',
            'SA'    =>  'Saudi Arabia',
            'SN'    =>  'Senegal',
            'SC'    =>  'Seychelles',
            'SL'    =>  'Sierra Leone',
            'SG'    =>  'Singapore',
            'SK'    =>  'Slovak Republic',
            'SI'    =>  'Slovenia',
            'SB'    =>  'Solomon Islands',
            'SO'    =>  'Somalia',
            'ZA'    =>  'South Africa',
            'GS'    =>  'South Georgia And South Sandwich Islands',
            'KR'    =>  'South Korea',
            'ES'    =>  'Spain',
            'LK'    =>  'Sri Lanka',
            'SD'    =>  'Sudan',
            'SR'    =>  'Suriname',
            'SJ'    =>  'Svalbard And Jan Mayen',
            'SZ'    =>  'Swaziland',
            'SE'    =>  'Sweden',
            'CH'    =>  'Switzerland',
            'SY'    =>  'Syria',
            'TW'    =>  'Taiwan',
            'TJ'    =>  'Tajikistan',
            'TZ'    =>  'Tanzania',
            'TH'    =>  'Thailand',
            'TG'    =>  'Togo',
            'TK'    =>  'Tokelau',
            'TO'    =>  'Tonga',
            'TT'    =>  'Trinidad And Tobago',
            'TN'    =>  'Tunisia',
            'TR'    =>  'Turkey',
            'TM'    =>  'Turkmenistan',
            'TC'    =>  'Turks And Caicos Islands',
            'TV'    =>  'Tuvalu',
            'UG'    =>  'Uganda',
            'UA'    =>  'Ukraine',
            'AE'    =>  'United Arab Emirates',
            'UK'    =>  'United Kingdom',
            'US'    =>  'United States',
            'UM'    =>  'United States Minor Outlying Islands',
            'UY'    =>  'Uruguay',
            'UZ'    =>  'Uzbekistan',
            'VU'    =>  'Vanuatu',
            'VA'    =>  'Vatican City (Holy See)',
            'VE'    =>  'Venezuela',
            'VN'    =>  'Vietnam',
            'VG'    =>  'Virgin Islands (British)',
            'VI'    =>  'Virgin Islands (US)',
            'WF'    =>  'Wallis And Futuna Islands',
            'EH'    =>  'Western Sahara',
            'WS'    =>  'Western Samoa',
            'YE'    =>  'Yemen',
            'YU'    =>  'Yugoslavia',
            'ZM'    =>  'Zambia',
            'ZW'    =>  'Zimbabwe'
        );
        
        return $code_to_country[$code];
    }
}