<?php


namespace KomjIT\LarAgent\Models\Document\Receipt;

use KomjIT\LarAgent\Models\Header\ReverseReceiptHeader;

/**
 * Sztornó nyugta
 *
 * @package LarAgent\Document\Receipt
 */
class ReverseReceipt extends Receipt
{
    /**
     * Sztornó nyugta létrehozása nyugtaszám alapján
     *
     * @param string $receiptNumber
     */
    public function __construct($receiptNumber = '')
    {
        parent::__construct(null);
        $this->setHeader(new ReverseReceiptHeader($receiptNumber));
    }
}
