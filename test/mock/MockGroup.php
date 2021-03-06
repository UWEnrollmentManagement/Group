<?php

namespace UWDOEM\Group\Test;

use UWDOEM\Connection\Connection;
use UWDOEM\Group\Group;

class MockGroup extends Group
{

    /**
     * @param string $baseUrl
     * @return Connection
     * @throws \Exception If any of the required constants have not been set.
     */
    protected static function makeConnection($baseUrl)
    {
        $requiredConstants = ["UW_GWS_BASE_PATH", "UW_GWS_SSL_KEY_PATH", "UW_GWS_SSL_CERT_PATH", "UW_GWS_SSL_KEY_PASSWD"];

        foreach ($requiredConstants as $constant) {
            if (defined($constant) === false) {
                throw new \Exception("You must define the constant $constant before using this library.");
            }
        }
        return new MockConnection(
            UW_GWS_BASE_PATH . $baseUrl,
            UW_GWS_SSL_KEY_PATH,
            UW_GWS_SSL_CERT_PATH,
            UW_GWS_SSL_KEY_PASSWD,
            defined("UW_GWS_VERBOSE") && UW_GWS_VERBOSE,
            [CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false]
        );
    }

    /**
     * @return Connection
     */
    protected static function getGroupConnection()
    {
        if (static::$groupConnection === null) {
            static::$groupConnection = static::makeConnection("group/");
        }
        return static::$groupConnection;
    }
}
