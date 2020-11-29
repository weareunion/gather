<?php
namespace Union\processor;

use Union\API\Cards\Issuing\GiftCardIssuing;
use Union\Exceptions\InvalidParams;


/**
 * PROCESSOR FUNCTION
 *
 * Issues a card and notifies client
 *
 * @param $data:
 * amount: (gift card amount),
 * payment: {
 * method: (method of payment),
 * attributes: (attributes such as payment process ID)
 * },
 * contact: {
 * type: null,
 * value: null
 * }
 *
 * @return string[]
 * @throws InvalidParams
 */
function run( $data){

    // Verify parameters
    if (!isset($data['amount'], $data['payment'], $data['payment']['method'], $data['contact'], $data['contact']['type'], $data['contact']['value'])){
        throw new InvalidParams("Parameters are missing. Check documentation.");
    }


    if (!isset($data['payment']['attributes']) || !is_array($data['payment']['attributes'])){
        $data['payment']['attributes'] = [];
    }

    // Extract and check amount
    $amount = (float)$data['amount'];
    if ($amount < 0.01){
        throw new InvalidParams("Invalid amount. Check documentation.");
    }

    // Import issuing client
    require_once __DIR__ . "/../classes/GiftCardIssuing.php";

    return GiftCardIssuing::quick_issue($data['amount'], $data['payment']['method'], $data['contact']['value'] ,$data['contact']['type'], $data['payment']['attributes']);
}