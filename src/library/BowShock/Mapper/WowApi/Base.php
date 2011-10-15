<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Mapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * WowApi Base Mapper
 *
 * @package    Mapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
abstract class BowShock_Mapper_WowApi_Base
{

    /**
     * Method used to call the api
     *
     * @var string
     */
    protected $method = '';

    /**
     * Api Region
     *
     * @var string
     */
    private $region = null;

    /**
     * @var Zend_Http_Client
     */
    private $client = null;

    /**
     * Init region
     */
    public function __construct()
    {
        $this->region = BowShock_WowApi_Region::REGION_EUROPE;
    }

    /**
     * @param Zend_Http_Client $client
     */
    public function setClient(Zend_Http_Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Zend_Http_Client
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new Zend_Http_Client();
        }
        return $this->client;
    }

    /**
     * @return the region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return BowShock_WowApi_Region::getRegionApiUri($this->region)
            . $this->method;
    }

    /**
     * Add Parameter to Http Call
     *
     * @param string $key
     * @param string $value
     * @return BowShock_Mapper_WowApi_Base
     */
    protected function addParameter($key, $value)
    {
        $this->getClient()->setParameterGet($key, $value);
        return $this;
    }

    /**
     * Call Wow Api
     *
     * @throws BowShock_Mapper_NotFoundException
     * @throws BowShock_WowApi_Exception
     * @return json array
     */
    protected function call()
    {
        $httpClient = $this->getClient();
        $httpClient->resetParameters(true);
        $httpClient->setUri($this->getUrl());

        $result = $this->getClient()->request('GET');

        if ($result->getStatus() == 404) {
            require_once 'BowShock/Mapper/NotFoundException.php';
            throw new BowShock_Mapper_NotFoundException("Wow Api Document {$this->getUrl()} not found!");
        }
        if ($result->getStatus() !== 200) {
            require_once 'BowShock/WowApi/Exception.php';
            throw new BowShock_WowApi_Exception("Wrong return code {$result->getStatus()}!");
        }

        $resultBody = $result->getBody();
        try {
            $json = Zend_Json::decode($resultBody);
        } catch (Zend_Json_Exception $e) {
            require_once 'BowShock/WowApi/Exception.php';
            throw new BowShock_WowApi_Exception('Unnable to parse result: ' . $e->getMessage(), 0, $e);
        }

        return $json;
    }

}