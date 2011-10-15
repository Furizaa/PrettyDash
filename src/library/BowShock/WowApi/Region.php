<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    WowApi
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Wow Region
 *
 * @package    WowApi
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_WowApi_Region
{

    const REGION_EUROPE = 'eu';
    const REGION_US     = 'us';
    const REGION_TAIWAN = 'tw';
    const REGION_KOREA  = 'kr';
    const REGION_CHINA  = 'cn';
    const REGION_JAPAN  = 'jp';
    const REGION_BRAZIL = 'br';

    /**
     * @var array
     */
    private static $apiRegionUri = array(
        self::REGION_EUROPE => 'http://eu.battle.net/api/wow/',
        self::REGION_US => 'http://us.battle.net/api/wow/',
        self::REGION_KOREA  => 'http://us.battle.net/api/wow/'
    );

    /**
     * Get WoW Api Uri for region
     *
     * @param string $region
     * @throws BowShock_WowApi_Exception
     */
    public static function getRegionApiUri($region)
    {
        if (!array_key_exists($region, self::$apiRegionUri)) {
            require_once 'BowShock/WowApi/Exception.php';
            throw new BowShock_WowApi_Exception('Unsupported region ' . $region);
        }
        return self::$apiRegionUri[$region];
    }

}