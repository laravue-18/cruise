<script setup>
import { ref, computed } from 'vue'
import { Combobox, ComboboxInput, ComboboxButton, ComboboxOptions, ComboboxOption, TransitionRoot} from '@headlessui/vue'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

const query = ref('')

const items = [
    { value: "AF", label: "Afghanistan"},
    { value: "AL", label: "Albania"},
    { value: "DZ", label: "Algeria"},
    { value: "AS", label: "American Samoa"},
    { value: "AD", label: "Andorra"},
    { value: "AO", label: "Angola"},
    { value: "AI", label: "Anguilla"},
    { value: "AQ", label: "Antarctica"},
    { value: "AG", label: "Antigua and Barbuda"},
    { value: "AR", label: "Argentina"},
    { value: "AM", label: "Armenia"},
    { value: "AW", label: "Aruba"},
    { value: "AU", label: "Australia"},
    { value: "AT", label: "Austria"},
    { value: "AZ", label: "Azerbaijan"},
    { value: "BS", label: "Bahamas (the)"},
    { value: "BH", label: "Bahrain"},
    { value: "BD", label: "Bangladesh"},
    { value: "BB", label: "Barbados"},
    { value: "BY", label: "Belarus"},
    { value: "BE", label: "Belgium"},
    { value: "BZ", label: "Belize"},
    { value: "BJ", label: "Benin"},
    { value: "BM", label: "Bermuda"},
    { value: "BT", label: "Bhutan"},
    { value: "BO", label: "Bolivia (Plurinational State of)"},
    { value: "BQ", label: "Bonaire, Sint Eustatius and Saba"},
    { value: "BA", label: "Bosnia and Herzegovina"},
    { value: "BW", label: "Botswana"},
    { value: "BV", label: "Bouvet Island"},
    { value: "BR", label: "Brazil"},
    { value: "IO", label: "British Indian Ocean Territory (the)"},
    { value: "BN", label: "Brunei Darussalam"},
    { value: "BG", label: "Bulgaria"},
    { value: "BF", label: "Burkina Faso"},
    { value: "BI", label: "Burundi"},
    { value: "CV", label: "Cabo Verde"},
    { value: "KH", label: "Cambodia"},
    { value: "CM", label: "Cameroon"},
    { value: "CA", label: "Canada"},
    { value: "KY", label: "Cayman Islands (the)"},
    { value: "CF", label: "Central African Republic (the)"},
    { value: "TD", label: "Chad"},
    { value: "CL", label: "Chile"},
    { value: "CN", label: "China"},
    { value: "CX", label: "Christmas Island"},
    { value: "CC", label: "Cocos (Keeling) Islands (the)"},
    { value: "CO", label: "Colombia"},
    { value: "KM", label: "Comoros (the)"},
    { value: "CD", label: "Congo (the Democratic Republic of the)"},
    { value: "CG", label: "Congo (the)"},
    { value: "CK", label: "Cook Islands (the)"},
    { value: "CR", label: "Costa Rica"},
    { value: "HR", label: "Croatia"},
    { value: "CU", label: "Cuba"},
    { value: "CW", label: "Curaçao"},
    { value: "CY", label: "Cyprus"},
    { value: "CZ", label: "Czechia"},
    { value: "CI", label: "Côte d'Ivoire"},
    { value: "DK", label: "Denmark"},
    { value: "DJ", label: "Djibouti"},
    { value: "DM", label: "Dominica"},
    { value: "DO", label: "Dominican Republic (the)"},
    { value: "EC", label: "Ecuador"},
    { value: "EG", label: "Egypt"},
    { value: "SV", label: "El Salvador"},
    { value: "GQ", label: "Equatorial Guinea"},
    { value: "ER", label: "Eritrea"},
    { value: "EE", label: "Estonia"},
    { value: "SZ", label: "Eswatini"},
    { value: "ET", label: "Ethiopia"},
    { value: "FK", label: "Falkland Islands (the) [Malvinas]"},
    { value: "FO", label: "Faroe Islands (the)"},
    { value: "FJ", label: "Fiji"},
    { value: "FI", label: "Finland"},
    { value: "FR", label: "France"},
    { value: "GF", label: "French Guiana"},
    { value: "PF", label: "French Polynesia"},
    { value: "TF", label: "French Southern Territories (the)"},
    { value: "GA", label: "Gabon"},
    { value: "GM", label: "Gambia (the)"},
    { value: "GE", label: "Georgia"},
    { value: "DE", label: "Germany"},
    { value: "GH", label: "Ghana"},
    { value: "GI", label: "Gibraltar"},
    { value: "GR", label: "Greece"},
    { value: "GL", label: "Greenland"},
    { value: "GD", label: "Grenada"},
    { value: "GP", label: "Guadeloupe"},
    { value: "GU", label: "Guam"},
    { value: "GT", label: "Guatemala"},
    { value: "GG", label: "Guernsey"},
    { value: "GN", label: "Guinea"},
    { value: "GW", label: "Guinea-Bissau"},
    { value: "GY", label: "Guyana"},
    { value: "HT", label: "Haiti"},
    { value: "HM", label: "Heard Island and McDonald Islands"},
    { value: "VA", label: "Holy See (the)"},
    { value: "HN", label: "Honduras"},
    { value: "HK", label: "Hong Kong"},
    { value: "HU", label: "Hungary"},
    { value: "IS", label: "Iceland"},
    { value: "IN", label: "India"},
    { value: "ID", label: "Indonesia"},
    { value: "IR", label: "Iran (Islamic Republic of)"},
    { value: "IQ", label: "Iraq"},
    { value: "IE", label: "Ireland"},
    { value: "IM", label: "Isle of Man"},
    { value: "IL", label: "Israel"},
    { value: "IT", label: "Italy"},
    { value: "JM", label: "Jamaica"},
    { value: "JP", label: "Japan"},
    { value: "JE", label: "Jersey"},
    { value: "JO", label: "Jordan"},
    { value: "KZ", label: "Kazakhstan"},
    { value: "KE", label: "Kenya"},
    { value: "KI", label: "Kiribati"},
    { value: "KP", label: "Korea (the Democratic People's Republic of)"},
    { value: "KR", label: "Korea (the Republic of)"},
    { value: "KW", label: "Kuwait"},
    { value: "KG", label: "Kyrgyzstan"},
    { value: "LA", label: "Lao People's Democratic Republic (the)"},
    { value: "LV", label: "Latvia"},
    { value: "LB", label: "Lebanon"},
    { value: "LS", label: "Lesotho"},
    { value: "LR", label: "Liberia"},
    { value: "LY", label: "Libya"},
    { value: "LI", label: "Liechtenstein"},
    { value: "LT", label: "Lithuania"},
    { value: "LU", label: "Luxembourg"},
    { value: "MO", label: "Macao"},
    { value: "MG", label: "Madagascar"},
    { value: "MW", label: "Malawi"},
    { value: "MY", label: "Malaysia"},
    { value: "MV", label: "Maldives"},
    { value: "ML", label: "Mali"},
    { value: "MT", label: "Malta"},
    { value: "MH", label: "Marshall Islands (the)"},
    { value: "MQ", label: "Martinique"},
    { value: "MR", label: "Mauritania"},
    { value: "MU", label: "Mauritius"},
    { value: "YT", label: "Mayotte"},
    { value: "MX", label: "Mexico"},
    { value: "FM", label: "Micronesia (Federated States of)"},
    { value: "MD", label: "Moldova (the Republic of)"},
    { value: "MC", label: "Monaco"},
    { value: "MN", label: "Mongolia"},
    { value: "ME", label: "Montenegro"},
    { value: "MS", label: "Montserrat"},
    { value: "MA", label: "Morocco"},
    { value: "MZ", label: "Mozambique"},
    { value: "MM", label: "Myanmar"},
    { value: "NA", label: "Namibia"},
    { value: "NR", label: "Nauru"},
    { value: "NP", label: "Nepal"},
    { value: "NL", label: "Netherlands (the)"},
    { value: "NC", label: "New Caledonia"},
    { value: "NZ", label: "New Zealand"},
    { value: "NI", label: "Nicaragua"},
    { value: "NE", label: "Niger (the)"},
    { value: "NG", label: "Nigeria"},
    { value: "NU", label: "Niue"},
    { value: "NF", label: "Norfolk Island"},
    { value: "MP", label: "Northern Mariana Islands (the)"},
    { value: "NO", label: "Norway"},
    { value: "OM", label: "Oman"},
    { value: "PK", label: "Pakistan"},
    { value: "PW", label: "Palau"},
    { value: "PS", label: "Palestine, State of"},
    { value: "PA", label: "Panama"},
    { value: "PG", label: "Papua New Guinea"},
    { value: "PY", label: "Paraguay"},
    { value: "PE", label: "Peru"},
    { value: "PH", label: "Philippines (the)"},
    { value: "PN", label: "Pitcairn"},
    { value: "PL", label: "Poland"},
    { value: "PT", label: "Portugal"},
    { value: "PR", label: "Puerto Rico"},
    { value: "QA", label: "Qatar"},
    { value: "MK", label: "Republic of North Macedonia"},
    { value: "RO", label: "Romania"},
    { value: "RU", label: "Russian Federation (the)"},
    { value: "RW", label: "Rwanda"},
    { value: "RE", label: "Réunion"},
    { value: "BL", label: "Saint Barthélemy"},
    { value: "SH", label: "Saint Helena, Ascension and Tristan da Cunha"},
    { value: "KN", label: "Saint Kitts and Nevis"},
    { value: "LC", label: "Saint Lucia"},
    { value: "MF", label: "Saint Martin (French part)"},
    { value: "PM", label: "Saint Pierre and Miquelon"},
    { value: "VC", label: "Saint Vincent and the Grenadines"},
    { value: "WS", label: "Samoa"},
    { value: "SM", label: "San Marino"},
    { value: "ST", label: "Sao Tome and Principe"},
    { value: "SA", label: "Saudi Arabia"},
    { value: "SN", label: "Senegal"},
    { value: "RS", label: "Serbia"},
    { value: "SC", label: "Seychelles"},
    { value: "SL", label: "Sierra Leone"},
    { value: "SG", label: "Singapore"},
    { value: "SX", label: "Sint Maarten (Dutch part)"},
    { value: "SK", label: "Slovakia"},
    { value: "SI", label: "Slovenia"},
    { value: "SB", label: "Solomon Islands"},
    { value: "SO", label: "Somalia"},
    { value: "ZA", label: "South Africa"},
    { value: "GS", label: "South Georgia and the South Sandwich Islands"},
    { value: "SS", label: "South Sudan"},
    { value: "ES", label: "Spain"},
    { value: "LK", label: "Sri Lanka"},
    { value: "SD", label: "Sudan (the)"},
    { value: "SR", label: "Suriname"},
    { value: "SJ", label: "Svalbard and Jan Mayen"},
    { value: "SE", label: "Sweden"},
    { value: "CH", label: "Switzerland"},
    { value: "SY", label: "Syrian Arab Republic"},
    { value: "TW", label: "Taiwan"},
    { value: "TJ", label: "Tajikistan"},
    { value: "TZ", label: "Tanzania, United Republic of"},
    { value: "TH", label: "Thailand"},
    { value: "TL", label: "Timor-Leste"},
    { value: "TG", label: "Togo"},
    { value: "TK", label: "Tokelau"},
    { value: "TO", label: "Tonga"},
    { value: "TT", label: "Trinidad and Tobago"},
    { value: "TN", label: "Tunisia"},
    { value: "TR", label: "Turkey"},
    { value: "TM", label: "Turkmenistan"},
    { value: "TC", label: "Turks and Caicos Islands (the)"},
    { value: "TV", label: "Tuvalu"},
    { value: "UG", label: "Uganda"},
    { value: "UA", label: "Ukraine"},
    { value: "AE", label: "United Arab Emirates (the)"},
    { value: "GB", label: "United Kingdom of Great Britain and Northern Ireland (the)"},
    { value: "UM", label: "United States Minor Outlying Islands (the)"},
    { value: "US", label: "United States of America"},
    { value: "UY", label: "Uruguay"},
    { value: "UZ", label: "Uzbekistan"},
    { value: "VU", label: "Vanuatu"},
    { value: "VE", label: "Venezuela (Bolivarian Republic of)"},
    { value: "VN", label: "Viet Nam"},
    { value: "VG", label: "Virgin Islands (British)"},
    { value: "VI", label: "Virgin Islands (U.S.)"},
    { value: "WF", label: "Wallis and Futuna"},
    { value: "EH", label: "Western Sahara"},
    { value: "YE", label: "Yemen"},
    { value: "ZM", label: "Zambia"},
    { value: "ZW", label: "Zimbabwe"},
    { value: "AX", label: "Åland Islands}"}
];

const filtered = computed(() => 
    query.value === ''
    ? items
    : items.filter((item) =>
        item.label
          .toLowerCase()
          .replace(/\s+/g, '')
          .startsWith(query.value.toLowerCase().replace(/\s+/g, ''))
      )
)

</script>

<template>
    <Combobox v-model="value" v-slot="{ open }">
        <div v-if="!open" class="text-white mb-12">
            <h1 class="text-6xl font-bold text-white mb-12">Get A Quote</h1>
            <p class="lg:w-[37rem] text-lg font-light mb-12">
                Complete our quick form and we'll showcase the top travel 
                insurance plans tailored just for you, including precise pricing. 
            </p>
        </div>
        <div class="lg:w-[35rem] text-xl lg:text-2xl">
            <h2 v-if="open" class="mb-6">Add Destination</h2>
            <div class="relative ">
                <ComboboxInput
                    class="w-full text-white bg-[#41a2df] h-16 pl-6 pr-12 text-2xl focus:ring-0 cursor-default overflow-hidden rounded-lg border border-[#C7C7C7] focus:border-[#FF9900]"
                    :displayValue="(country) => items.find(i => i.value === country)?.label || country"
                    @change="query = $event.target.value"
                />
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <Icon type="md-pin" size="30" color="#C7C7C7" />
                </ComboboxButton>
            </div>
            
            <div v-if="open" class="h-96">
                <ComboboxOptions class="border mt-2 max-h-96 w-full overflow-auto rounded-md bg-white py-1">
                    <div v-if="filtered.length === 0 && query !== ''"
                        class="relative cursor-default select-none px-4 py-2 text-gray-700"
                    >
                        Nothing found.
                    </div>

                    <ComboboxOption v-for="item in filtered" as="template" :key="item.value" :value="item.value">
                        <li class="hover:bg-[#FF990040] relative cursor-default select-none px-6">
                            <div class="py-6 border-b">
                                <span class="block truncate" > {{ item.label }} </span>
                            </div>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </div>
        </div>
    </Combobox>
    <div>
        <div>
        </div>
    </div>
</template>