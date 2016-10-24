<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data
{

    public function __construct()
    {

    }

    public function get_countries()
    {
        return array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    }

    public function get_states()
    {

        $states = array(
            0 => 'Alabama',
            1 => 'Alaska',
            2 => 'Arizona',
            3 => 'Arkansas',
            4 => 'California',
            5 => 'Colorado',
            6 => 'Connecticut',
            7 => 'Delaware',
            8 => 'Florida',
            9 => 'Georgia',
            10 => 'Hawaii',
            11 => 'Idaho',
            12 => 'Illinois',
            13 => 'Indiana',
            14 => 'Iowa',
            15 => 'Kansas',
            16 => 'Kentucky',
            17 => 'Louisiana',
            18 => 'Maine',
            19 => 'Maryland',
            20 => 'Massachusetts',
            21 => 'Michigan',
            22 => 'Minnesota',
            23 => 'Mississippi',
            24 => 'Missouri',
            25 => 'Montana',
            26 => 'Nebraska',
            27 => 'Nevada',
            28 => 'New Hampshire',
            29 => 'New Jersey',
            30 => 'New Mexico',
            31 => 'New York',
            32 => 'North Carolina',
            33 => 'North Dakota',
            34 => 'Ohio',
            35 => 'Oklahoma',
            36 => 'Oregon',
            37 => 'Pennsylvania',
            38 => 'Rhode Island',
            39 => 'South Carolina',
            40 => 'South Dakota',
            41 => 'Tennessee',
            42 => 'Texas',
            43 => 'Utah',
            44 => 'Vermont',
            45 => 'Virginia',
            46 => 'Washington',
            47 => 'West Virginia',
            48 => 'Wisconsin',
            49 => 'Wyoming',
            50 => 'Alberta',
            51 => 'British Columbia',
            52 => 'Manitoba',
            53 => 'New Brunswick',
            54 => 'Newfoundland and Labrador',
            55 => 'Northwest Territories',
            56 => 'Nova Scotia',
            57 => 'Nunavut',
            58 => 'Ontario',
            59 => 'Prince Edward Island',
            60 => 'Québec',
            61 => 'Saskatchewan',
            62 => 'Yukon');

        asort($states);

        return $states;
    }

    public function get_card_types()
    {
        return array('' => 'Select Card Type', 5 => 'Master Card', 6 => 'VISA', 7 => 'American Express');
    }

    public function get_months()
    {
        $months = cal_info(0);
        return $months['months'];
    }

    public function get_years()
    {
        $current_year = date('Y');
        $years = array();
        for ($i = $current_year; $i  <= $current_year + 20; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }
}