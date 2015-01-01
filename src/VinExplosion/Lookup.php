<?php

namespace VinExplosion;

/**
 * Class Lookup
 * @package VinExplosion
 */
class Lookup
{

    /**
     * @var Account
     */
    protected $account;
    /**
     * @var string
     */
    protected $responseType = 'application/json';
    /**
     * @var string
     */
    protected $autoCorrectionStatus = 'true';

    /**
     * @var array
     */
    protected $responseStatusCodes = [
        200 => 'OK',
        401 => 'Unauthorized: Your credentials are invalid or you do not have the required permission to access the resource',
        403 => 'Forbidden: The request did not included an acceptable authorization scheme',
        500 => 'Internal Server Error: This indicates that there may be a problem with the API',
    ];

    /**
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @param $vin
     * @return mixed
     */
    public function requestVinInformation($vin)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://vinexplosion.com/api/vin/decode/{$vin}/?fuzzy=" . $this->getAutoCorrectionStatus());
        curl_setopt($ch, CURLOPT_USERPWD, $this->account->getAuthenticationString());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getAcceptHeader());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $this->guardAgainstInvalidResponse($code);

        curl_close($ch);

        return $response;
    }

    /**
     * @return string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * @param $type
     */
    public function setResponseType($type)
    {
        $this->guardAgainstInvalidResponseType($type);
        $this->responseType = $type;
    }

    /**
     * @param $type
     */
    private function guardAgainstInvalidResponseType($type)
    {
        if (!in_array($type, ['application/json', 'application/xml', 'text/xml'])) {
            throw new \InvalidArgumentException("Invalid response type of {$type} provided.");
        }
    }

    /**
     * @return string
     */
    public function getAutoCorrectionStatus()
    {
        return $this->autoCorrectionStatus;
    }

    /**
     * @param $status
     */
    public function setAutoCorrectionStatus($status)
    {
        if (is_bool($status))
            $status = $status ? 'true' : 'false';

        $this->autoCorrectionStatus = $status;
    }

    /**
     * @return array
     */
    private function getAcceptHeader()
    {
        return ['Accept: ' . $this->getResponseType()];
    }

    /**
     * @param $code
     * @throws Exception
     */
    private function guardAgainstInvalidResponse($code)
    {
        if ($this->responseCodeIsInvalid($code))
            throw new Exception($this->getResponseMessage($code));
    }

    /**
     * @param $code
     * @return mixed
     */
    private function getResponseMessage($code)
    {
        return $this->responseStatusCodes[$code];
    }

    /**
     * @param $code
     * @return bool
     */
    private function responseCodeIsInvalid($code)
    {
        return $code != 200;
    }
}