<?php

class Time {

    protected static $countries;

    public static function init() {
        self::$countries = array();
        self::$countries['AF'] = 'Afghanistan';
        self::$countries['AX'] = 'Åland Islands';
        self::$countries['AL'] = 'Albania';
        self::$countries['DZ'] = 'Algeria';
        self::$countries['AS'] = 'American Samoa';
        self::$countries['AD'] = 'Andorra';
        self::$countries['AO'] = 'Angola';
        self::$countries['AI'] = 'Anguilla';
        self::$countries['AQ'] = 'Antarctica';
        self::$countries['AG'] = 'Antigua and Barbuda';
        self::$countries['AR'] = 'Argentina';
        self::$countries['AM'] = 'Armenia';
        self::$countries['AW'] = 'Aruba';
        self::$countries['AU'] = 'Australia';
        self::$countries['AT'] = 'Austria';
        self::$countries['AZ'] = 'Azerbaijan';
        self::$countries['BS'] = 'Bahamas';
        self::$countries['BH'] = 'Bahrain';
        self::$countries['BD'] = 'Bangladesh';
        self::$countries['BB'] = 'Barbados';
        self::$countries['BY'] = 'Belarus';
        self::$countries['BE'] = 'Belgium';
        self::$countries['BZ'] = 'Belize';
        self::$countries['BJ'] = 'Benin';
        self::$countries['BM'] = 'Bermuda';
        self::$countries['BT'] = 'Bhutan';
        self::$countries['BO'] = 'Bolivia';
        self::$countries['BQ'] = 'Bonaire, Sint Eustatius and Saba';
        self::$countries['BA'] = 'Bosnia and Herzegovina';
        self::$countries['BW'] = 'Botswana';
        self::$countries['BV'] = 'Bouvet Island';
        self::$countries['BR'] = 'Brazil';
        self::$countries['IO'] = 'British Indian Ocean Territory';
        self::$countries['BN'] = 'Brunei Darussalam';
        self::$countries['BG'] = 'Bulgaria';
        self::$countries['BF'] = 'Burkina Faso';
        self::$countries['BI'] = 'Burundi';
        self::$countries['KH'] = 'Cambodia';
        self::$countries['CM'] = 'Cameroon';
        self::$countries['CA'] = 'Canada';
        self::$countries['CV'] = 'Cape Verde';
        self::$countries['KY'] = 'Cayman Islands';
        self::$countries['CF'] = 'Central African Republic';
        self::$countries['TD'] = 'Chad';
        self::$countries['CL'] = 'Chile';
        self::$countries['CN'] = 'China';
        self::$countries['CX'] = 'Christmas Island';
        self::$countries['CC'] = 'Cocos (Keeling) Islands';
        self::$countries['CO'] = 'Colombia';
        self::$countries['KM'] = 'Comoros';
        self::$countries['CG'] = 'Congo';
        self::$countries['CD'] = 'Congo, the Democratic Republic of the';
        self::$countries['CK'] = 'Cook Islands';
        self::$countries['CR'] = 'Costa Rica';
        self::$countries['CI'] = 'Côte d\'Ivoire';
        self::$countries['HR'] = 'Croatia';
        self::$countries['CU'] = 'Cuba';
        self::$countries['CW'] = 'Curaçao';
        self::$countries['CY'] = 'Cyprus';
        self::$countries['CZ'] = 'Czech Republic';
        self::$countries['DK'] = 'Denmark';
        self::$countries['DJ'] = 'Djibouti';
        self::$countries['DM'] = 'Dominica';
        self::$countries['DO'] = 'Dominican Republic';
        self::$countries['EC'] = 'Ecuador';
        self::$countries['EG'] = 'Egypt';
        self::$countries['SV'] = 'El Salvador';
        self::$countries['GQ'] = 'Equatorial Guinea';
        self::$countries['ER'] = 'Eritrea';
        self::$countries['EE'] = 'Estonia';
        self::$countries['ET'] = 'Ethiopia';
        self::$countries['FK'] = 'Falkland Islands (Malvinas)';
        self::$countries['FO'] = 'Faroe Islands';
        self::$countries['FJ'] = 'Fiji';
        self::$countries['FI'] = 'Finland';
        self::$countries['FR'] = 'France';
        self::$countries['GF'] = 'French Guiana';
        self::$countries['PF'] = 'French Polynesia';
        self::$countries['TF'] = 'French Southern Territories';
        self::$countries['GA'] = 'Gabon';
        self::$countries['GM'] = 'Gambia';
        self::$countries['GE'] = 'Georgia';
        self::$countries['DE'] = 'Germany';
        self::$countries['GH'] = 'Ghana';
        self::$countries['GI'] = 'Gibraltar';
        self::$countries['GR'] = 'Greece';
        self::$countries['GL'] = 'Greenland';
        self::$countries['GD'] = 'Grenada';
        self::$countries['GP'] = 'Guadeloupe';
        self::$countries['GU'] = 'Guam';
        self::$countries['GT'] = 'Guatemala';
        self::$countries['GG'] = 'Guernsey';
        self::$countries['GN'] = 'Guinea';
        self::$countries['GW'] = 'Guinea-Bissau';
        self::$countries['GY'] = 'Guyana';
        self::$countries['HT'] = 'Haiti';
        self::$countries['HM'] = 'Heard Island and McDonald Islands';
        self::$countries['VA'] = 'Holy See (Vatican City State)';
        self::$countries['HN'] = 'Honduras';
        self::$countries['HK'] = 'Hong Kong';
        self::$countries['HU'] = 'Hungary';
        self::$countries['IS'] = 'Iceland';
        self::$countries['IN'] = 'India';
        self::$countries['ID'] = 'Indonesia';
        self::$countries['IR'] = 'Iran';
        self::$countries['IQ'] = 'Iraq';
        self::$countries['IE'] = 'Ireland';
        self::$countries['IM'] = 'Isle of Man';
        self::$countries['IL'] = 'Israel';
        self::$countries['IT'] = 'Italy';
        self::$countries['JM'] = 'Jamaica';
        self::$countries['JP'] = 'Japan';
        self::$countries['JE'] = 'Jersey';
        self::$countries['JO'] = 'Jordan';
        self::$countries['KZ'] = 'Kazakhstan';
        self::$countries['KE'] = 'Kenya';
        self::$countries['KI'] = 'Kiribati';
        self::$countries['KP'] = 'Korea, Democratic People\'s Republic of';
        self::$countries['KR'] = 'Korea, Republic of';
        self::$countries['KW'] = 'Kuwait';
        self::$countries['KG'] = 'Kyrgyzstan';
        self::$countries['LA'] = 'Lao People\'s Democratic Republic';
        self::$countries['LV'] = 'Latvia';
        self::$countries['LB'] = 'Lebanon';
        self::$countries['LS'] = 'Lesotho';
        self::$countries['LR'] = 'Liberia';
        self::$countries['LY'] = 'Libya';
        self::$countries['LI'] = 'Liechtenstein';
        self::$countries['LT'] = 'Lithuania';
        self::$countries['LU'] = 'Luxembourg';
        self::$countries['MO'] = 'Macao';
        self::$countries['MK'] = 'Macedonia';
        self::$countries['MG'] = 'Madagascar';
        self::$countries['MW'] = 'Malawi';
        self::$countries['MY'] = 'Malaysia';
        self::$countries['MV'] = 'Maldives';
        self::$countries['ML'] = 'Mali';
        self::$countries['MT'] = 'Malta';
        self::$countries['MH'] = 'Marshall Islands';
        self::$countries['MQ'] = 'Martinique';
        self::$countries['MR'] = 'Mauritania';
        self::$countries['MU'] = 'Mauritius';
        self::$countries['YT'] = 'Mayotte';
        self::$countries['MX'] = 'Mexico';
        self::$countries['FM'] = 'Micronesia';
        self::$countries['MD'] = 'Moldova';
        self::$countries['MC'] = 'Monaco';
        self::$countries['MN'] = 'Mongolia';
        self::$countries['ME'] = 'Montenegro';
        self::$countries['MS'] = 'Montserrat';
        self::$countries['MA'] = 'Morocco';
        self::$countries['MZ'] = 'Mozambique';
        self::$countries['MM'] = 'Myanmar';
        self::$countries['NA'] = 'Namibia';
        self::$countries['NR'] = 'Nauru';
        self::$countries['NP'] = 'Nepal';
        self::$countries['NL'] = 'Netherlands';
        self::$countries['NC'] = 'New Caledonia';
        self::$countries['NZ'] = 'New Zealand';
        self::$countries['NI'] = 'Nicaragua';
        self::$countries['NE'] = 'Niger';
        self::$countries['NG'] = 'Nigeria';
        self::$countries['NU'] = 'Niue';
        self::$countries['NF'] = 'Norfolk Island';
        self::$countries['MP'] = 'Northern Mariana Islands';
        self::$countries['NO'] = 'Norway';
        self::$countries['OM'] = 'Oman';
        self::$countries['PK'] = 'Pakistan';
        self::$countries['PW'] = 'Palau';
        self::$countries['PS'] = 'Palestine';
        self::$countries['PA'] = 'Panama';
        self::$countries['PG'] = 'Papua New Guinea';
        self::$countries['PY'] = 'Paraguay';
        self::$countries['PE'] = 'Peru';
        self::$countries['PH'] = 'Philippines';
        self::$countries['PN'] = 'Pitcairn';
        self::$countries['PL'] = 'Poland';
        self::$countries['PT'] = 'Portugal';
        self::$countries['PR'] = 'Puerto Rico';
        self::$countries['QA'] = 'Qatar';
        self::$countries['RE'] = 'Réunion';
        self::$countries['RO'] = 'Romania';
        self::$countries['RU'] = 'Russian Federation';
        self::$countries['RW'] = 'Rwanda';
        self::$countries['BL'] = 'Saint Barthélemy';
        self::$countries['SH'] = 'Saint Helena, Ascension and Tristan da Cunha';
        self::$countries['KN'] = 'Saint Kitts and Nevis';
        self::$countries['LC'] = 'Saint Lucia';
        self::$countries['MF'] = 'Saint Martin';
        self::$countries['PM'] = 'Saint Pierre and Miquelon';
        self::$countries['VC'] = 'Saint Vincent and the Grenadines';
        self::$countries['WS'] = 'Samoa';
        self::$countries['SM'] = 'San Marino';
        self::$countries['ST'] = 'Sao Tome and Principe';
        self::$countries['SA'] = 'Saudi Arabia';
        self::$countries['SN'] = 'Senegal';
        self::$countries['RS'] = 'Serbia';
        self::$countries['SC'] = 'Seychelles';
        self::$countries['SL'] = 'Sierra Leone';
        self::$countries['SG'] = 'Singapore';
        self::$countries['SX'] = 'Sint Maarten';
        self::$countries['SK'] = 'Slovakia';
        self::$countries['SI'] = 'Slovenia';
        self::$countries['SB'] = 'Solomon Islands';
        self::$countries['SO'] = 'Somalia';
        self::$countries['ZA'] = 'South Africa';
        self::$countries['GS'] = 'South Georgia and the South Sandwich Islands';
        self::$countries['SS'] = 'South Sudan';
        self::$countries['ES'] = 'Spain';
        self::$countries['LK'] = 'Sri Lanka';
        self::$countries['SD'] = 'Sudan';
        self::$countries['SR'] = 'Suriname';
        self::$countries['SJ'] = 'Svalbard and Jan Mayen';
        self::$countries['SZ'] = 'Swaziland';
        self::$countries['SE'] = 'Sweden';
        self::$countries['CH'] = 'Switzerland';
        self::$countries['SY'] = 'Syrian Arab Republic';
        self::$countries['TW'] = 'Taiwan';
        self::$countries['TJ'] = 'Tajikistan';
        self::$countries['TZ'] = 'Tanzania';
        self::$countries['TH'] = 'Thailand';
        self::$countries['TL'] = 'Timor-Leste';
        self::$countries['TG'] = 'Togo';
        self::$countries['TK'] = 'Tokelau';
        self::$countries['TO'] = 'Tonga';
        self::$countries['TT'] = 'Trinidad and Tobago';
        self::$countries['TN'] = 'Tunisia';
        self::$countries['TR'] = 'Turkey';
        self::$countries['TM'] = 'Turkmenistan';
        self::$countries['TC'] = 'Turks and Caicos Islands';
        self::$countries['TV'] = 'Tuvalu';
        self::$countries['UG'] = 'Uganda';
        self::$countries['UA'] = 'Ukraine';
        self::$countries['AE'] = 'United Arab Emirates';
        self::$countries['GB'] = 'United Kingdom';
        self::$countries['US'] = 'United States';
        self::$countries['UM'] = 'United States Minor Outlying Islands';
        self::$countries['UY'] = 'Uruguay';
        self::$countries['UZ'] = 'Uzbekistan';
        self::$countries['VU'] = 'Vanuatu';
        self::$countries['VE'] = 'Venezuela';
        self::$countries['VN'] = 'Viet Nam';
        self::$countries['VG'] = 'Virgin Islands, British';
        self::$countries['VI'] = 'Virgin Islands, U.S.';
        self::$countries['WF'] = 'Wallis and Futuna';
        self::$countries['EH'] = 'Western Sahara';
        self::$countries['YE'] = 'Yemen';
        self::$countries['ZM'] = 'Zambia';
        self::$countries['ZW'] = 'Zimbabwe';
    }

    public static function getCountries() {
        return self::$countries;
    }

    public static function getCountryName($countryCode, $defaultValue = '') {
        if (isset(self::$countries[$countryCode])) {
            return self::$countries[$countryCode];
        }
        else {
            return $defaultValue;
        }
    }

    public static function getTimezones($country) {
        return DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country);
    }

    public static function getTimeAgo($timestamp) {
        $secondsAgo = time()-$timestamp;
        if ($secondsAgo < 60) { // less than a minute passed
            return 'just now';
        }
        elseif ($secondsAgo < 3600) { // minutes have passed
            $minutesAgo = round($secondsAgo / 60);
            return $minutesAgo.' '.($minutesAgo == 1 ? 'minute' : 'minutes').' ago';
        }
        elseif ($secondsAgo < 86400) { // hours have passed
            $hoursAgo = round($secondsAgo / 3600);
            return $hoursAgo.' '.($hoursAgo == 1 ? 'hour' : 'hours').' ago';
        }
        else { // days have passed
            $daysAgo = round($secondsAgo / 86400);
            return $daysAgo.' '.($daysAgo == 1 ? 'day' : 'days').' ago';
        }
    }

}