<?php

namespace Box\Managers;

use Box\Config\BoxConstants;
use Box\Models\BoxModelConstants;

/**
 * Class BoxFoldersManager
 *
 * @package Box\Managers
 */
class BoxSearchManager extends BoxResourceManager
{

    const SEARCH_REQUIRED_PROPERTIES = [BoxModelConstants::BOX_SEARCH_PARAMS_QUERY];

    /**
     * BoxSearchManager constructor.
     *
     * @param \Box\BoxClient $boxClient BoxClient instance.
     */
    function __construct($boxClient)
    {
        parent::__construct($boxClient);
    }

    /**
     * Get search items.
     *
     * https://developer.box.com/#searching-for-content
     *
     * @param string   $params            Array of params.
     * @param string[] $additionalHeaders Additional HTTP header key-value pairs.
     * @param bool     $runAsync          Run asynchronously.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSearchResults($query, $params = null, $additionalHeaders = null, $runAsync = false)
    {
        if ($params == null){
            $params = array();
        }
        $params[BoxModelConstants::BOX_SEARCH_PARAMS_QUERY] = $query;
        $uri       = parent::createUri(BoxConstants::SEARCH_ENDPOINT_STRING, $params);
        $request   = parent::alterBaseBoxRequest($this->getBaseBoxRequest(), BoxConstants::GET, $uri, $additionalHeaders);
        return parent::requestTypeResolver($request, [], $runAsync);
    }

}
