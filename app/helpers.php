<?php

use App\Http\Traits\ApiResponse;
use App\Mail\ClientEditProductBeforeDelivery;
use App\Models\Blog;
use App\Models\Coach;
use App\Models\Copen;
use App\Models\Country;
use App\Models\Language;
use App\Models\Options;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\UserPlan;
use App\Models\Zip;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

//

function responseSuccess($data, string $message = null, int $code = 200)
{
    return (new ApiResponse)->success($data, $message, $code);
}

function responseError($data, string $message = null, int $code = 400)
{
    return (new ApiResponse)->error($data, $message, $code);
}

function getValue($array, $sting)
{
    return Arr::get($array, $sting);
}


function themeStyleClasses()
{
    $theme_setting = config('themeSetting');
    $classes = '';
    if ($theme_setting['themeStyle'] !== 'default' && $theme_setting['themeStyle'] !== '') {
        $classes .= $theme_setting['themeStyle'];
    }
    if ($theme_setting['headerColor'] !== 'default' && $theme_setting['headerColor'] !== '') {
        $classes .= ' color-header ' . $theme_setting['headerColor'];
    }
    if ($theme_setting['sideBarColor'] !== 'default' && $theme_setting['sideBarColor'] !== '') {
        $classes .= ' color-sidebar ' . $theme_setting['sideBarColor'];
    }
    return  $classes;
}

function getLanguages()
{
    return Language::get();
}

function getTemplates()
{
    return config('pageTemplates');
}

function getMediaById($id)
{
    return  Media::find($id);
}

function getMediaUrlById($id)
{
    if (Media::find($id))
        return Media::find($id)->getUrl();
}

function stringToDotArray($string)
{
    $replaced = Str::replaceLast(']', '', $string);
    $replaced = Str::replaceFirst('[', '.', $replaced);
    $replaced = Str::replace('][', '.', $replaced);
    return  $replaced;
}


function getCountries()
{
    return Country::get();
}

function getCoaches()
{
    return Coach::has('user')->get();
}

function getBlogs()
{
    return Blog::get();
}

function getTestimonials()
{
    return Testimonial::get();
}

// make product nutration pivot array

function getNutrationArray($for, $value)
{
    $nutritionsAmountArray = [];
    $key = 0;
    collect($for)->map(function ($item) use (&$nutritionsAmountArray, &$key, $value) {
        $nutritionsAmountArray += [$item => ['amount' => $value[$key]]];
        $key++;
    });
    return $nutritionsAmountArray;
}
// function getPivotArray($for, $firstPivotValue, $pivotname)
// {
//     $array = [];
//     $array2 = [];
//     $key = 0;
//     collect($for)->map(function ($item) use (&$array, &$array2, &$key, $firstPivotValue, $pivotname) {
//         collect($pivotname)->map(function ($label) use ($key, $firstPivotValue, &$array2) {
//             $array2 += [
//                 $label => $firstPivotValue[$key]
//             ];
//         });
//         $array += [
//             $item => $array2
//         ];
//         $key++;
//     });
//     return $array;
// }

// checking 72 hours left

function isWeekDateEditable($value)
{
    $date = Carbon::parse($value);
    if ($date->diffInDays(now()) > 3) {
        return true;
    } else {
        if ($date->isPast()) {
            return true;
        } else {
            return false;
        }
    }
}

// check for 96 hours for sending mail
function check96HoursLeft($value)
{
    $date = Carbon::parse($value);
    if ($date->diffInHours(now()) > 96 && $date->diffInHours(now()) < 120) {
        return true;
    } else {
        return false;
    }
}

// getting recent delivery global variable
function getDeliveryDate()
{
    return [
        'from' => Carbon::parse(now())->addDay()->toDateString(),
        'to' => Carbon::parse(now())->addDay()->toDateString()
    ];
}

//date jahan delivery nai hougi
function getForbiddenDeliveryDates()
{
    Options::where('key', 'forbiddenDeliveryDates')->first();
}

// make custom error red
function add_error($error_msg, $key = 'default')
{
    $errors = Session::get('errors', new ViewErrorBag);

    if (!$errors instanceof ViewErrorBag) {
        $errors = new ViewErrorBag;
    }

    $bag = $errors->getBags()['default'] ?? new MessageBag();
    $bag->add($key, $error_msg);

    Session::flash(
        'errors',
        $errors->put('default', $bag)
    );
}
// setting authorize.net authentication
function setANET()
{
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(env('ANET_API_LOGIN_ID'));
    $merchantAuthentication->setTransactionKey(env('ANET_TRANSACTION_KEY'));
    return $merchantAuthentication;
}
// create customer in authorize.net
function createANETCustomerProfileThenSubscription($array)
{
    try {
        //code...

        /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = setANET();

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create a Customer Profile Request
        //  1. (Optionally) create a Payment Profile
        //  2. (Optionally) create a Shipping Profile
        //  3. Create a Customer Profile (or specify an existing profile)
        //  4. Submit a CreateCustomerProfile Request
        //  5. Validate Profile ID returned

        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($array['card']['card_number']);
        $creditCard->setExpirationDate($array['card']['expiry_date']);
        // $creditCard->setCardCode("142");
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        // Create the Bill To info for new payment type
        $billTo = new AnetAPI\CustomerAddressType();
        $billTo->setFirstName($array['user']['first_name']);
        $billTo->setLastName($array['user']['last_name']);
        $billTo->setAddress($array['user']['address']);
        $billTo->setCity($array['user']['city']);
        $billTo->setState($array['user']['state']);
        $billTo->setZip($array['user']['zip']);
        $billTo->setPhoneNumber($array['user']['phone']);
        // $billTo->setCountry("USA");
        // $billTo->setfaxNumber("999-999-9999");

        // Create a customer shipping address
        // $customerShippingAddress = new AnetAPI\CustomerAddressType();
        // $customerShippingAddress->setFirstName("James");
        // $customerShippingAddress->setLastName("White");
        // $customerShippingAddress->setCompany("Addresses R Us");
        // $customerShippingAddress->setAddress(rand() . " North Spring Street");
        // $customerShippingAddress->setCity("Toms River");
        // $customerShippingAddress->setState("NJ");
        // $customerShippingAddress->setZip("08753");
        // $customerShippingAddress->setCountry("USA");
        // $customerShippingAddress->setPhoneNumber("888-888-8888");
        // $customerShippingAddress->setFaxNumber("999-999-9999");

        // Create an array of any shipping addresses
        // $shippingProfiles[] = $customerShippingAddress;


        // Create a new CustomerPaymentProfile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setBillTo($billTo);
        $paymentProfile->setPayment($paymentCreditCard);
        $paymentProfiles[] = $paymentProfile;


        // Create a new CustomerProfileType and add the payment profile object
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setDescription("Customer created when buying " . $array['plan']['name']);
        $customerProfile->setMerchantCustomerId(auth()->id());
        $customerProfile->setEmail($array['user']['email']);
        $customerProfile->setpaymentProfiles($paymentProfiles);
        // $customerProfile->setShipToList($shippingProfiles);


        // Assemble the complete transaction request
        $request = new AnetAPI\CreateCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setProfile($customerProfile);

        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            //     echo "Succesfully created customer profile : " . $response->getCustomerProfileId() . "\n";
            //     $paymentProfiles = $response->getCustomerPaymentProfileIdList();
            //     echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
        } else {
            $errorMessages = $response->getMessages()->getMessage();
            throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
        }

        return $response;
    } catch (\Throwable $th) {
        throw $th;
    }
}

// create authorize.net subscription
function createANETSubscription($array)
{

    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName($array['plan']['name']);

    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength($array['plan']['length']);
    $interval->setUnit($array['plan']['unit']);

    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    // $paymentSchedule->setStartDate(new DateTime('2022-03-26'));
    $paymentSchedule->setStartDate($array['plan']['start_date']);
    $paymentSchedule->setTotalOccurrences($array['plan']['occurrences']);
    if (array_key_exists('coupen', $array)) {
        $paymentSchedule->setTrialOccurrences($array['coupen']['trialoccurrences']);
    }

    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount($array['plan']['price']);
    if (array_key_exists('coupen', $array)) {
        $subscription->setTrialAmount($array['coupen']['trialprice']);
    }

    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($array['card']['card_number']);
    $creditCard->setExpirationDate($array['card']['expiry_date']);

    $payment = new AnetAPI\PaymentType();
    $payment->setCreditCard($creditCard);
    $subscription->setPayment($payment);

    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber($array['plan']['order_id']);
    $order->setDescription($array['user']['email'] . ' purchase ' . $array['plan']['name']);
    $subscription->setOrder($order);

    $billTo = new AnetAPI\NameAndAddressType();
    $billTo->setFirstName($array['user']['first_name']);
    $billTo->setLastName($array['user']['last_name']);
    $billTo->setAddress($array['user']['address']);
    $billTo->setCity($array['user']['city']);
    $billTo->setState($array['user']['state']);
    $billTo->setZip($array['user']['zip']);


    $subscription->setBillTo($billTo);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);
    $controller = new AnetController\ARBCreateSubscriptionController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // echo "SUCCESS: Subscription ID : " . $response->getSubscriptionId() . "\n";
    } else {
        $errorMessages = $response->getMessages()->getMessage();
        // $msg = collect(config('authorizenet'))->where('code', $errorMessages[0]->getCode())->first();
        // Storage::put('suberror.txt',  "Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n");
        // $response = array('error' => $errorMessages[0]->getText(), 'code' => $errorMessages[0]->getCode());
        throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
    }

    return $response;
}
// update customer information in authorize.net
function updateANETCustomerInfo($array)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();

    // Update an existing customer profile

    $updatecustomerprofile = new AnetAPI\CustomerProfileExType();
    $updatecustomerprofile->setCustomerProfileId($array['anet']['anet_profile_id']);
    $updatecustomerprofile->setDescription("Updated on " . now()->toDayDateTimeString());
    $updatecustomerprofile->setMerchantCustomerId(auth()->id());
    $updatecustomerprofile->setEmail($array['user']['email']);

    $request = new AnetAPI\UpdateCustomerProfileRequest();
    $request->setMerchantAuthentication($merchantAuthentication);

    $request->setProfile($updatecustomerprofile);

    $controller = new AnetController\UpdateCustomerProfileController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // echo "UpdateCustomerProfile SUCCESS : " .  "\n";
    } else {
        $errorMessages = $response->getMessages()->getMessage();
        throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
    }
    return $response;
}
// create ANET Subscription From authorize.net CustomerProfile
function createANETSubscriptionFromCustomerProfile($array)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();

    // Set the transaction's refId
    $refId = 'ref' . time();


    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName($array['plan']['name']);

    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength($array['plan']['length']);
    $interval->setUnit($array['plan']['unit']);

    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    $paymentSchedule->setStartDate($array['plan']['start_date']);
    $paymentSchedule->setTotalOccurrences($array['plan']['occurrences']);
    if (array_key_exists('coupen', $array)) {
        $paymentSchedule->setTrialOccurrences($array['coupen']['trialoccurrences']);
    }


    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount($array['plan']['price']);
    if (array_key_exists('coupen', $array)) {
        $subscription->setTrialAmount($array['coupen']['trialprice']);
    }


    $profile = new AnetAPI\CustomerProfileIdType();
    $profile->setCustomerProfileId($array['anet']['anet_profile_id']);
    $profile->setCustomerPaymentProfileId($array['anet']['anet_payment_id']);
    // $profile->setCustomerAddressId($customerAddressId);

    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber($array['plan']['order_id']);
    $subscription->setOrder($order);

    $subscription->setProfile($profile);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);
    $controller = new AnetController\ARBCreateSubscriptionController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // echo "SUCCESS: Subscription ID : " . $response->getSubscriptionId() . "\n";

    } else {
        $errorMessages = $response->getMessages()->getMessage();
        // $msg = collect(config('authorizenet'))->where('code', $errorMessages[0]->getCode())->first();
        // Storage::put('suberror.txt',  "Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n");
        // $response = array('error' => $errorMessages[0]->getText(), 'code' => $errorMessages[0]->getCode());
        throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
    }

    return $response;
}
// get subscription
function getANETSubscription($subscriptionId)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();

    // Set the transaction's refId
    $refId = 'ref' . time();

    // Creating the API Request with required parameters
    $request = new AnetAPI\ARBGetSubscriptionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);
    $request->setIncludeTransactions(true);

    // Controller
    $controller = new AnetController\ARBGetSubscriptionController($request);

    // Getting the response
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if ($response != null) {
        if ($response->getMessages()->getResultCode() == "Ok") {
            // // Success
            // echo "SUCCESS: GetSubscription:" . "\n";
            // // Displaying the details
            // echo "Subscription Name: " . $response->getSubscription()->getName() . "\n";
            // echo "Subscription amount: " . $response->getSubscription()->getAmount() . "\n";
            // echo "Subscription status: " . $response->getSubscription()->getStatus() . "\n";
            // echo "Subscription Description: " . $response->getSubscription()->getProfile()->getDescription() . "\n";
            // echo "Customer Profile ID: " .  $response->getSubscription()->getProfile()->getCustomerProfileId() . "\n";
            // echo "Customer payment Profile ID: " . $response->getSubscription()->getProfile()->getPaymentProfile()->getCustomerPaymentProfileId() . "\n";
            // $transactions = $response->getSubscription()->getArbTransactions();
            // if ($transactions != null) {
            //     foreach ($transactions as $transaction) {
            //         echo "Transaction ID : " . $transaction->getTransId() . " -- " . $transaction->getResponse() . " -- Pay Number : " . $transaction->getPayNum() . "\n";
            //     }
            // }
        } else {
            // Error
            $errorMessages = $response->getMessages()->getMessage();
            throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
        }
    } else {
        // Failed to get response
        throw new \Exception(json_encode('Null Response Error'));
    }

    return $response;
}
// get subscription status
function getANETSubscriptionStatus($subscriptionId)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();

    // Set the transaction's refId
    $refId = 'ref' . time();

    $request = new AnetAPI\ARBGetSubscriptionStatusRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);

    $controller = new AnetController\ARBGetSubscriptionStatusController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // echo "SUCCESS: Subscription Status : " . $response->getStatus() . "\n";
    } else {
        // echo "ERROR :  Invalid response\n";
        // $errorMessages = $response->getMessages()->getMessage();
        // echo "Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n";
    }

    return $response;
}
// update total occuranse of subscription
function updateEndDateANETSubscription($array)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();


    // Set the transaction's refId
    $refId = 'ref' . time();

    $subscription = new AnetAPI\ARBSubscriptionType();

    //set customer profile information
    //$subscription->setProfile($profile);
    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    if (array_key_exists('coupen', $array)) {
        $paymentSchedule->setTrialOccurrences($array['coupen']['trialoccurrences']);
    }
    $paymentSchedule->setTotalOccurrences($array['plan']['occurrences']);

    $subscription->setPaymentSchedule($paymentSchedule);
    if (array_key_exists('coupen', $array)) {
        $subscription->setTrialAmount($array['coupen']['trialprice']);
    }


    $request = new AnetAPI\ARBUpdateSubscriptionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($array['subscription']['anet_id']);
    $request->setSubscription($subscription);

    $controller = new AnetController\ARBUpdateSubscriptionController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // $errorMessages = $response->getMessages()->getMessage();
        // echo "SUCCESS Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n";
    } else {
        $errorMessages = $response->getMessages()->getMessage();
        throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
    }

    return $response;
}
// cancel subscription
function cancelANETSubscription($subscriptionId)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = setANET();

    // Set the transaction's refId
    $refId = 'ref' . time();

    $request = new AnetAPI\ARBCancelSubscriptionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);

    $controller = new AnetController\ARBCancelSubscriptionController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        // $successMessages = $response->getMessages()->getMessage();
        // echo "SUCCESS : " . $successMessages[0]->getCode() . "  " . $successMessages[0]->getText() . "\n";
    } else {
        $errorMessages = $response->getMessages()->getMessage();
        throw new \Exception(json_encode($errorMessages[0]->getText()), (int)$errorMessages[0]->getCode());
    }

    return $response;
}

function getAdminEmail()
{
    return Options::where('key', 'admin_email')->first()->value;
}

function convertStringToArray($array)
{
    // if ($a != '[]' || $a != null) {
    $a = explode(',', $array);
    foreach ($a  as $x => $val) {
        $a[$x] = str_replace(str_split('\\/:*?"<>|()[]"'), '', $val);
    }
    return $a;
    // } else {
    //     return array();
    // }
}
// if userplan expires today it will update expire and weeks date
function scheduleUserPlanUpdateExpireAt()
{
    try {
        $userplans = UserPlan::where('status', 2)->where(
            DB::raw("(STR_TO_DATE(user_plans.expire_at,'%Y-%m-%d'))"),
            "=",
            Carbon::today()->format('Y-m-d')
        )->get();

        foreach ($userplans as $userplan) {
            $userplan->update([
                'expire_at' => now()->addMonth(),
                'week1' => getModifiedWeekDate($userplan->week1),
                'week2' => getModifiedWeekDate($userplan->week2),
                'week3' => getModifiedWeekDate($userplan->week3),
                'week4' => getModifiedWeekDate($userplan->week4)
            ]);
        }
    } catch (\Exception $e) {
        //throw $th;
    }
}
// it will make pending plan to active
function scheduleUserPlanPendingToActive()
{
    try {
        //getting all pending plan
        $userplans = UserPlan::where('status', 1)->get();
        foreach ($userplans as $userplan) {
            $userQueueToCancelPlan = UserPlan::where('user_id', $userplan->user_id)->where('status', 3)->first();

            //checking if userQueueToCancelPlan is expired
            if ($userQueueToCancelPlan->expire_at->isPast()) {
                cancelANETSubscription($userQueueToCancelPlan->anet_subscription_id);
                $userQueueToCancelPlan->update([
                    'status' => 0,
                    'coupen_id' => ''
                ]);

                // for creating new subscription
                $array = [
                    'plan' => [
                        'name' => $userplan->plan->name,
                        'length' => 7,
                        'unit' => 'days',
                        'occurrences' => '9999',
                        'price' => $userplan->price,
                        'order_id' => $userplan->id,
                        'start_date' => now()->addDay(),
                    ],
                    'anet' => [
                        'anet_profile_id' => $userplan->user->anet_profile_id,
                        'anet_payment_id' => $userplan->user->anet_payment_id,
                    ],

                ];

                // if coupen is applied
                if (!is_null($userplan->coupen_id)) {
                    $discount = Copen::find($userplan->coupen_id)->discount;
                    $taxRate = Zip::where('name', $userplan->user->zip)->first()->tax_rate;
                    $pricePerWeek = $userplan->price;
                    $taxRateAmount = $pricePerWeek * $taxRate / 100;
                    $pricePerWeek = $pricePerWeek + $taxRateAmount;
                    $pricePerWeek = $pricePerWeek - ($pricePerWeek * ($discount / 100));
                    $array += [
                        'coupen' => [
                            'trialprice' => number_format((float) $pricePerWeek, 2, '.', ''),
                            'trialoccurrences' => 4 * 3, //week * month
                        ]
                    ];
                }

                $response = createANETSubscriptionFromCustomerProfile($array);
                $w1 = CarbonImmutable::parse(getModifiedWeekDate($userplan->week1));
                $userplan->update([
                    'status' => 2,
                    'anet_subscription_id' => $response->getSubscriptionId(),
                    'expire_at' => now()->addMonth(),
                    'week1' => $w1,
                    'week2' => modifyDateDay($w1->addWeek()),
                    'week3' => modifyDateDay($w1->addWeek(2)),
                    'week4' => modifyDateDay($w1->addWeek(3)),
                    'coupen_id' => null
                ]);
            }
        }
    } catch (\Exception $e) {
        //throw $th;
    }
}
//it will make pending plan to inactive
function scheduleUserPlanToInactive()
{
    try {
        $userplans = UserPlan::where('status', 3)->get();

        foreach ($userplans as $userplan) {
            if ($userplan->expire_at->isPast()) {
                $userplan->update([
                    'status' => 0
                ]);
            }
        }
    } catch (\Exception $e) {
        //throw $th;
    }
}

function scheduleEmailSent4DaysBeforDelivery()
{
    $userplans = UserPlan::where('status', 2)->orWhere('status', 3)->get();
    foreach ($userplans as $userplan) {
        $checkForWeek = $userplan->weekToBePaid();
        if ($checkForWeek['canSendMail']) {
            $oldProducts = [];
            DB::table('product_user')
                ->where('user_id', $userplan->user_id)
                ->where('plan_id', $userplan->plan_id)
                ->get(['product_id', 'quantity'])
                ->map(function ($item) use (&$oldProducts) {
                    $oldProducts += [
                        Product::find($item->product_id)->name =>
                        $item->quantity,
                    ];
                })->toArray();


            $array = [
                'old_product' => $oldProducts,
                'week' => $checkForWeek['name'],
                'btn-url' => route('frontend.plan.product.edit', ['user' => $userplan->user->email, 'plan' => $userplan->plan->name])
            ];
            // return new ClientEditProductBeforeDelivery($array);
            Mail::to($userplan->user->email)->send(new ClientEditProductBeforeDelivery($array));
        }
    }
}
// it will modify weekdate
function getModifiedWeekDate($date)
{
    $a = Carbon::parse($date)->format('d') . '-' . now()->format('m') . '-' . now()->format('Y');
    $b =  Carbon::parse($a);
    $day = Carbon::parse($date)->format('l');
    return $b->modify($day);
}

function modifyDateDay($date)
{
    $b =  Carbon::parse($date);
    $day = Carbon::parse($date)->format('l');
    return $b->modify($day);
}

// function getModifiedWeekDates($userplan)
// {
//     $w1 = CarbonImmutable::parse(getModifiedWeekDate($userplan->week1));

//     dd(
//         'week1' . $w1,
//         'week2' . modifyDateDay($w1->addWeek()),
//         'week3' . modifyDateDay($w1->addWeek(2)),
//         'week4' . modifyDateDay($w1->addWeek(3)),
//         'asasas',
//         'week1' . getModifiedWeekDate($userplan->week1),
//         'week2' . getModifiedWeekDate($userplan->week2),
//         'week3' . getModifiedWeekDate($userplan->week3),
//         'week4' . getModifiedWeekDate($userplan->week4),
//     );
// }

// for any further information about code contact muddasirali99@gmail.com

// function updateANETSubscription($subscriptionId)
// {
//     /* Create a merchantAuthenticationType object with authentication details
//        retrieved from the constants file */
//     $merchantAuthentication = setANET();

//     // Set the transaction's refId
//     $refId = 'ref' . time();

//     $subscription = new AnetAPI\ARBSubscriptionType();

//     $creditCard = new AnetAPI\CreditCardType();
//     $creditCard->setCardNumber("4111111111111111");
//     $creditCard->setExpirationDate("2038-12");

//     $payment = new AnetAPI\PaymentType();
//     $payment->setCreditCard($creditCard);

//     //set profile information
//     $profile = new AnetAPI\CustomerProfileIdType();
//     $profile->setCustomerProfileId("121212");
//     $profile->setCustomerPaymentProfileId("131313");
//     $profile->setCustomerAddressId("141414");

//     $subscription->setPayment($payment);

//     //set customer profile information
//     //$subscription->setProfile($profile);

//     $request = new AnetAPI\ARBUpdateSubscriptionRequest();
//     $request->setMerchantAuthentication($merchantAuthentication);
//     $request->setRefId($refId);
//     $request->setSubscriptionId($subscriptionId);
//     $request->setSubscription($subscription);

//     $controller = new AnetController\ARBUpdateSubscriptionController($request);

//     $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

//     if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
//         $errorMessages = $response->getMessages()->getMessage();
//         echo "SUCCESS Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n";
//     } else {
//         echo "ERROR :  Invalid response\n";
//         $errorMessages = $response->getMessages()->getMessage();
//         echo "Response : " . $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n";
//     }

//     return $response;
// }
