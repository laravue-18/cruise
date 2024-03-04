<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $with = ['highlights', 'benefits'];
    protected $appends = array('group_benefits');

    public $countries =  ["BD" => "BGD", "BE" => "BEL", "BF" => "BFA", "BG" => "BGR", "BA" => "BIH", "BB" => "BRB", "WF" => "WLF", "BL" => "BLM", "BM" => "BMU", "BN" => "BRN", "BO" => "BOL", "BH" => "BHR", "BI" => "BDI", "BJ" => "BEN", "BT" => "BTN", "JM" => "JAM", "BV" => "BVT", "BW" => "BWA", "WS" => "WSM", "BQ" => "BES", "BR" => "BRA", "BS" => "BHS", "JE" => "JEY", "BY" => "BLR", "BZ" => "BLZ", "RU" => "RUS", "RW" => "RWA", "RS" => "SRB", "TL" => "TLS", "RE" => "REU", "TM" => "TKM", "TJ" => "TJK", "RO" => "ROU", "TK" => "TKL", "GW" => "GNB", "GU" => "GUM", "GT" => "GTM", "GS" => "SGS", "GR" => "GRC", "GQ" => "GNQ", "GP" => "GLP", "JP" => "JPN", "GY" => "GUY", "GG" => "GGY", "GF" => "GUF", "GE" => "GEO", "GD" => "GRD", "GB" => "GBR", "GA" => "GAB", "SV" => "SLV", "GN" => "GIN", "GM" => "GMB", "GL" => "GRL", "GI" => "GIB", "GH" => "GHA", "OM" => "OMN", "TN" => "TUN", "JO" => "JOR", "HR" => "HRV", "HT" => "HTI", "HU" => "HUN", "HK" => "HKG", "HN" => "HND", "HM" => "HMD", "VE" => "VEN", "PR" => "PRI", "PS" => "PSE", "PW" => "PLW", "PT" => "PRT", "SJ" => "SJM", "PY" => "PRY", "IQ" => "IRQ", "PA" => "PAN", "PF" => "PYF", "PG" => "PNG", "PE" => "PER", "PK" => "PAK", "PH" => "PHL", "PN" => "PCN", "PL" => "POL", "PM" => "SPM", "ZM" => "ZMB", "EH" => "ESH", "EE" => "EST", "EG" => "EGY", "ZA" => "ZAF", "EC" => "ECU", "IT" => "ITA", "VN" => "VNM", "SB" => "SLB", "ET" => "ETH", "SO" => "SOM", "ZW" => "ZWE", "SA" => "SAU", "ES" => "ESP", "ER" => "ERI", "ME" => "MNE", "MD" => "MDA", "MG" => "MDG", "MF" => "MAF", "MA" => "MAR", "MC" => "MCO", "UZ" => "UZB", "MM" => "MMR", "ML" => "MLI", "MO" => "MAC", "MN" => "MNG", "MH" => "MHL", "MK" => "MKD", "MU" => "MUS", "MT" => "MLT", "MW" => "MWI", "MV" => "MDV", "MQ" => "MTQ", "MP" => "MNP", "MS" => "MSR", "MR" => "MRT", "IM" => "IMN", "UG" => "UGA", "TZ" => "TZA", "MY" => "MYS", "MX" => "MEX", "IL" => "ISR", "FR" => "FRA", "IO" => "IOT", "SH" => "SHN", "FI" => "FIN", "FJ" => "FJI", "FK" => "FLK", "FM" => "FSM", "FO" => "FRO", "NI" => "NIC", "NL" => "NLD", "NO" => "NOR", "NA" => "NAM", "VU" => "VUT", "NC" => "NCL", "NE" => "NER", "NF" => "NFK", "NG" => "NGA", "NZ" => "NZL", "NP" => "NPL", "NR" => "NRU", "NU" => "NIU", "CK" => "COK", "XK" => "XKX", "CI" => "CIV", "CH" => "CHE", "CO" => "COL", "CN" => "CHN", "CM" => "CMR", "CL" => "CHL", "CC" => "CCK", "CA" => "CAN", "CG" => "COG", "CF" => "CAF", "CD" => "COD", "CZ" => "CZE", "CY" => "CYP", "CX" => "CXR", "CR" => "CRI", "CW" => "CUW", "CV" => "CPV", "CU" => "CUB", "SZ" => "SWZ", "SY" => "SYR", "SX" => "SXM", "KG" => "KGZ", "KE" => "KEN", "SS" => "SSD", "SR" => "SUR", "KI" => "KIR", "KH" => "KHM", "KN" => "KNA", "KM" => "COM", "ST" => "STP", "SK" => "SVK", "KR" => "KOR", "SI" => "SVN", "KP" => "PRK", "KW" => "KWT", "SN" => "SEN", "SM" => "SMR", "SL" => "SLE", "SC" => "SYC", "KZ" => "KAZ", "KY" => "CYM", "SG" => "SGP", "SE" => "SWE", "SD" => "SDN", "DO" => "DOM", "DM" => "DMA", "DJ" => "DJI", "DK" => "DNK", "VG" => "VGB", "DE" => "DEU", "YE" => "YEM", "DZ" => "DZA", "US" => "USA", "UY" => "URY", "YT" => "MYT", "UM" => "UMI", "LB" => "LBN", "LC" => "LCA", "LA" => "LAO", "TV" => "TUV", "TW" => "TWN", "TT" => "TTO", "TR" => "TUR", "LK" => "LKA", "LI" => "LIE", "LV" => "LVA", "TO" => "TON", "LT" => "LTU", "LU" => "LUX", "LR" => "LBR", "LS" => "LSO", "TH" => "THA", "TF" => "ATF", "TG" => "TGO", "TD" => "TCD", "TC" => "TCA", "LY" => "LBY", "VA" => "VAT", "VC" => "VCT", "AE" => "ARE", "AD" => "AND", "AG" => "ATG", "AF" => "AFG", "AI" => "AIA", "VI" => "VIR", "IS" => "ISL", "IR" => "IRN", "AM" => "ARM", "AL" => "ALB", "AO" => "AGO", "AQ" => "ATA", "AS" => "ASM", "AR" => "ARG", "AU" => "AUS", "AT" => "AUT", "AW" => "ABW", "IN" => "IND", "AX" => "ALA", "AZ" => "AZE", "IE" => "IRL", "ID" => "IDN", "UA" => "UKR", "QA" => "QAT", "MZ" => "MOZ"];

    public function getPriceFromDB($form) {
        return $this->getPriceFromApi($form);
    }

    public function getPriceFromApi($form, $pool = null) {
        $price = 0;
        if ($this->provider == 'World Trips') {
            $token = Token::where('provider', 'World Trips')->first()->token;
            $payload = [ 
                "meta" => [
                    "agentID" => 6229780,
                    "agencyID" => 5943595
                ],
                "eligibility" => [
                    "stateOfResidence" => $form['state']
                ],
                "trip" => [
                    "totalTripCost" => $form['total_trip_cost'],
                    "departureDate" => $form['leave_date'],
                    "returnDate" => $form['return_date'],
                    "initialDepositDate" => $form['first_paid_at'],
                ],
                "products" => [ ["code" => $this->code]],
                "buyups" => [],
            ];
            $payload['travelers'] = collect($form['travelers'])->map(function($traveler) {
                return [ "age" => Carbon::parse($traveler['birthday'])->age ];
            })->toArray();
    
            try {
                if($pool) {
                    return $pool->retry(3, 2000)->withToken($token)
                        ->post('https://beta.hccmis.com/iwebapi/api/V1/CTP/Quote/', $payload);
                } else {
                    $res = Http::withToken($token)
                        ->post('https://beta.hccmis.com/iwebapi/api/V1/CTP/Quote/', $payload);
                    $res = $res->json();
            
                    $price = $res['products'][0]['premiumAmount'];
                    if(count($payload['buyups'])){
                        foreach($res['products'][0]['buyups'] as $buyup){
                            $price += $buyup['premiumAmount'];
                        }
                    }
                }
        
                return $price;
            }catch(\Exception $e) {
                return 0;
            }
        } else if ($this->id == 3) { // Trawick - Safe Travels Voyager
            $token = Token::where('provider', 'Trawick')->first()->token;
            $payload = [ 
                "optionValues" => [],
                "startDate" => $form['leave_date'],
                "endDate" => $form['return_date'],
                "depositDate" => $form['first_paid_at'],
                "destinationCountry" => $form['destination'],
                "homeCountryCode" => "US",
                "tripCancellation" => true,
                "homeState" => $form['state'],
                "productIds" => [ 296 ],
                "loadOptionCost" => true,
            ];
            $payload['travelers'] = collect($form['travelers'])->map(function($traveler) use ($form){
                return [ "dateOfBirth" => $traveler['birthday'], "tripCost" => $form['total_trip_cost'] / count($form['travelers']) ];
            })->toArray();
    
            try {
                if($pool) {
                    return $pool->retry(3, 2000)->withToken($token)
                        ->post('https://apitest.trawickinternational.com/quote/quote', $payload);
                } else {
                    $res = Http::withToken($token)
                        ->post('https://beta.hccmis.com/iwebapi/api/V1/CTP/Quote/', $payload);
                    $res = $res->json();
            
                    $price = $res['products'][0]['premiumAmount'];
                    if(count($payload['buyups'])){
                        foreach($res['products'][0]['buyups'] as $buyup){
                            $price += $buyup['premiumAmount'];
                        }
                    }
                }
        
                return $price;
            }catch(\Exception $e) {
                return 0;
            }
            
        } else if($this->id == 4){ // Trawick - Safe Travels Outbound
            $price = 0;
            $ages = [60, 65, 70, 80, 100];
            $days = Carbon::parse($form['leave_date'])->diffInDays(Carbon::parse($form['return_date'])) + 1;
            foreach($form['travelers'] as $traveler){
                $age = Carbon::parse($traveler['birthday'])->diffInYears(Carbon::now());
                $age = min(array_filter($ages, fn ($i) => $age < $i));
                $policy_max = $form['policy_max'] ?? 50000;
                $deductible = $form['deductible'] ?? 0;
                $factors = [0 => 1.3, 50 => 1.2, 100 => 1.1, 250 => 1.0, 500 => 0.9, 1000 => 0.8, 2500 => 0.7];
                $row = SafeTravelsOutboundRate::where('age', $age)->where('policy_max', $policy_max)->first();
                $rate = ($form['state'] == 'PA' || $form['state'] == 'MO') ? $row->rate_2 : $row->rate;
                $price += $rate * $factors[$deductible] * $days;
                if(array_key_exists('trip_delay', $form)){
                    $price += [2000 => 0, 4000 => 8.50, 7000 => 14.00][$form['trip_delay']];
                }
            } 
            return $price;
        } else if ($this->provider == 'Geoblue') {
            $payload = [
                "linkid" => "258965",
                "Product" => $this->name,
                // "Zip" => "15095",
                "State" => $form['state'],
                "DepartureDate" => $form['leave_date'],
                "ReturnDate" => $form['return_date'],
                "TripCost" => $form['total_trip_cost'],
                "Destination" => $form['destination'],
                // "AgeList" => $form['travelers'][0]['age'],
            ];
            $payload['AgeList'] = collect($form['travelers'])->map(function($traveler) {
                return Carbon::parse($traveler['birthday'])->age;
            })->implode(',');

            $res = Http::retry(3, 2000)->withHeaders([
                'api_key' => 'p2gsfndkfqnbx5ra62vqdfdzptsyx5vcxsrytc79nkc2bmfnn7za3y9tbqjs6zdadjdbw8jkq72xusuk2qdf6y4x56ew2fh6ey569ehd77fzjahptfrz68nahk5wuuxx'
            ])->post('https://individualsalesapi-staging.betahth.com/individualsales/getquote', $payload)
            ->json();

            try {
                $quote = $res['Quotes'];
                return $quote;
            } catch (\Exception $e) {
                dd($res);
            }
        }
        return $price;
    }

    public function processRes($res) {
        $res = $res->json();
        $price = 0;
        try{
            if ($this->provider == 'Trawick') {
                $price = $res[0];
            } elseif ($this->provider == 'World Trips') {
                $price = $res['products'][0];
            } elseif ($this->provider == 'Geoblue') {
                $price = $res['Quotes'][0]['Rate'];
            }
        } catch (\Exception $e) {
            $price = 0;
        }
        return $price;
    }

    public function highlights() {
        return $this->hasMany(Highlight::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function getGroupBenefitsAttribute(){
        return $this->benefits()->get()->groupBy('benefit_type_id');
    }

    public function purchase($form, $cpform, $premium) {
        if($this->provider == 'Trawick') {
            $payload = [
                'product' => $this->code,
                'eff_date' => $form['leave_date'],
                'term_date' => $form['return_date'],
                'country' => 'US',
                'home_state' => $form['state'],
                'destination' => $form['destination'],
                
                'mainEmail' => $cpform['emails'][0],
                'phone' => $cpform['phones'][0],
                'street' => $cpform['address1'],
                'city' => $cpform['city'],
                'state' => $form['state'],
                'zip' => $cpform['zipCode'],
                'homecountry' => $cpform['country'],
                'cc_name' => $cpform['cardHolder'],
                'cc_street' => $cpform['address1'],
                'cc_city' => $cpform['city'],
                'cc_statecode' => $form['state'],
                'cc_postalcode' => $cpform['zipCode'],
                'cc_country' => $cpform['country'],
                'cc_number' => str_replace(' ', '', $cpform['cardNumber']),
                'cc_month' => $cpform['expireMonth'],
                'cc_year' => $cpform['expireYear'],
                'cc_cvv' => $cpform['cvv'],
                'completeOrder' => true,
                'agent_id' => 14695
            ];
            if($form['coverage_type'] == 'comprehensive'){
                $payload["cancelForAny"] = $form['cfar'] ? 'yes' : 'no';
                $payload["trip_cost_per_person"] = $form['total_trip_cost'] / $form['num'];
                $payload["trip_purchase_date"] = $form['first_paid_at'];
            }

            foreach($form['travelers'] as $key => $traveler) {
                $payload["dob" . ($key + 1)] = $traveler['birthday'];
                $payload["t" . ($key + 1) . "First"] = $traveler['f_name'];
                $payload["t" . ($key + 1) . "Last"] = $traveler['l_name'];
                $payload["t" . ($key + 1) . "Middle"] = "";
                $payload["t" . ($key + 1) . "Gender"] = $traveler['gender'];
            }

            if(array_key_exists('trip_delay', $form)) $payload['trip_delay'] = $form['trip_delay'];
    
            if(array_key_exists('deductible', $form))
                $payload['deductible'] = (int)$form['deductible'];
            if(array_key_exists('policy_max', $form))
                $payload['policy_max'] = (int)$form['policy_max'];

            try {
                $res = Http::retry(3, 2000)->asForm()
                    ->post('https://api2017.trawickinternational.com/API2016.asmx/ProcessRequest', $payload);
                
                $res = $res->json();
                dd($res);
        
                if($res['OrderStatusCode'] == 1)
                    $success = true;
                if($res['OrderStatusMessage'])
                    array_push($msg, $res['OrderStatusMessage']);
    
                return response()->json([
                    'success' => $success,
                    'msg' => $msg,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'msg' => [$e->getMessage()]
                ]);
            }
        } elseif ($this->provider == 'World Trips') {
            $token = Token::where('provider', 'World Trips')->first()->token;
            
            $payload = [ 
                "meta" => [
                    "agentID" => 6229780,
                    "agencyID" => 5943595,
                    "referenceID" => ""
                ],
                "trip" => [
                    "destCountryISOs" => [$this->countries[$form['destination']]],
                    "destinationState" => "",
                    "totalTripCost" => $form['total_trip_cost'],
                    "departureDate" => $form['leave_date'],
                    "returnDate" => $form['return_date'],
                    "initialDepositDate" => $form['first_paid_at'],
                    // "finalPaymentDate": null,
                    // "airline": "Delta",
                    // "tourOperator": "Tour Operator",
                    // "cruiseLine": "Carnival"
                ],
                "policyholder" => [
                    "address" => [
                        "street1" => $cpform['address1'],
                        "street2" => $cpform['address2'],
                        "city" => $cpform['city'],
                        "state" => $form['state'],
                        "postalCode" => $cpform['zipCode'],
                    ],
                    "phone" => $cpform['phones'][0],
                    "email" => $cpform['emails'][0]
                ],
                "product" => [
                    "code" => $this->code,
                    "buyups" => []
                ],
                "docDelivery" => [
                    "code" => "EMAIL"
                ],
                "payment" => [
                    "totalAmount" => $premium,
                    "creditCard" => [
                        "name" => $cpform['cardHolder'],
                        "number" => str_replace(' ', '', $cpform['cardNumber']),
                        "expMonth" => $cpform['expireMonth'],
                        "expYear" => $cpform['expireYear'],
                        "cvv" => $cpform['cvv'],
                        "address" => [
                            "street1" => $cpform['address1'],
                            "city" => $cpform['city'],
                            "state" => $form['state'],
                            "postalCode" => $cpform['zipCode']
                        ]
                    ],
                    // "cardToken" => [
                    //     "cardholderName" => "thanh test",
                    //     "transarmorToken" => "8091879832721111",
                    //     "expMonth" => "12",
                    //     "expYear" => "2024",
                    //     "transactionID" => "4602945868",
                    //     "authCode" => "ET112310",
                    //     "paymentType" => "Visa",
                    //     "purchaseDate" => "10/25/2024"
                    // ]
                ]
            ];
            $payload['travelers'] = collect($form['travelers'])->map(fn($traveler, $index) => [
                "travelerIndex" => $index,
                "firstName" => $traveler['f_name'],
                "middleInitial" => '',
                "lastName" => $traveler['l_name'],
                "birthDate" => $traveler['birthday'],
                "gender" => \Str::upper(\Str::substr($traveler['gender'], 0, 1))
            ])->toArray();

            $buyups = ["CNI", "ADV", "RVL", "PET", "BAG", "RAP", "SCH", "HAF", "DWD"];
            foreach($buyups as $buyup) {
                if($form[$buyup]) {
                    if($buyup == "CNI"){
                        $payload['product']['buyups'][] = [
                            "code" => "CNI",
                            "optionCode" => $form[$buyup]
                        ];
                    } else if($buyup == "RVL"){
                        $payload['product']['buyups'][] = [
                            "code" => "RVL",
                            "startDate" => $form['term']['start'],
                            "endDate" => $form['term']['end']
                        ];
                    } else {
                        $payload['product']['buyups'][] = ["code" => $buyup];
                    }
                }
            }

            try {
                $res = Http::withToken($token)
                    ->post('https://beta.hccmis.com/iwebapi/api/V1/CTP/Purchase', $payload);
        
                $res = $res->json();
                dd($res);
        
                if(\Arr::has($res, 'policy.policyNumber')) {
                    return [
                        'success' => true,
                        'data' => $res
                    ];
                }
            }catch(\Exception $e) {
                return 0;
            }
        }
    }
}
