<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Document;
use KomjIT\LarAgent\Models\Document\Invoice\Invoice;
use KomjIT\LarAgent\Models\SzamlaAgentException;
use KomjIT\LarAgent\Models\SzamlaAgentRequest;
use KomjIT\LarAgent\Models\SzamlaAgentUtil;

/**
 * Sztornó számla fejléc
 *
 * @package LarAgent\Header
 */
class ReverseInvoiceHeader extends InvoiceHeader
{

    /**
     * XML-ben kötelezően kitöltendő mezők
     *
     * @var array
     */
    protected $requiredFields = ['invoiceNumber'];

    /**
     * @param int $type
     *
     * @throws SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE)
    {
        parent::__construct($type);
        $this->setReserveInvoice(true);
    }

    /**
     * Ellenőrizzük a mező típusát
     *
     * @param $field
     * @param $value
     *
     * @return string
     * @throws SzamlaAgentException
     */
    public function checkField($field, $value)
    {
        if (property_exists(get_parent_class($this), $field) || property_exists($this, $field)) {
            $required = in_array($field, $this->getRequiredFields());
            switch ($field) {
                case 'issueDate':
                case 'fulfillment':
                    SzamlaAgentUtil::checkDateField($field, $value, $required, __CLASS__);
                    break;
                case 'invoiceNumber':
                case 'comment':
                    SzamlaAgentUtil::checkStrField($field, $value, $required, __CLASS__);
                    break;
            }
        }
        return $value;
    }

    /**
     * Összeállítja a bizonylat elkészítéséhez szükséges XML fejléc adatokat
     *
     * Csak azokat az XML mezőket adjuk hozzá, amelyek kötelezőek,
     * illetve amelyek opcionálisak, de ki vannak töltve.
     *
     * @param SzamlaAgentRequest $request
     *
     * @return array
     * @throws SzamlaAgentException
     */
    public function buildXmlData(SzamlaAgentRequest $request)
    {

        try {
            if (empty($request)) {
                throw new SzamlaAgentException(SzamlaAgentException::XML_DATA_NOT_AVAILABLE);
            }

            $data["szamlaszam"] = $this->getInvoiceNumber();

            if (!empty($this->getIssueDate())) $data['keltDatum'] = $this->getIssueDate();
            if (!empty($this->getFulfillment())) $data['teljesitesDatum'] = $this->getFulfillment();
            if (SzamlaAgentUtil::isNotBlank($this->getComment())) $data['megjegyzes'] = $this->getComment();

            $data['tipus'] = Document::DOCUMENT_TYPE_REVERSE_INVOICE_CODE;

            if (!empty($this->getInvoiceTemplate())) $data['szamlaSablon'] = $this->getInvoiceTemplate();

            $this->checkFields();

            return $data;
        } catch (SzamlaAgentException $e) {
            throw $e;
        }
    }
}
