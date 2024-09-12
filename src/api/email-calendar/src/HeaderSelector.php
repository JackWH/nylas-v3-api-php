<?php
/**
 * HeaderSelector
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * v3 Nylas Email and Calendar APIs
 *
 * This API reference covers the **Nylas Email and Calendar APIs**. See the see the [<b>Administration API documentation</b>](https:///docs/api/v3-beta/admin/) for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.  The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like GET, PUT, POST, and DELETE and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.  # Pagination  Some queries result in multiple pages of data. Nylas includes a `next_cursor` response body field when there are more pages of results. To get the next page, pass the value of this header as the `page_token` query parameter on your next request.  You can use the `limit` query parameter to specify the maximum number of results you want in the page. A page might have less than `limit` results, but that doesn't mean that it's the last page. Use the presences of the `next_cursor` response body field to determine if there are additional pages.  | Query Parameter | Type | Description | | --- | --- | --- | | `limit` | integer | The number of objects to return. This defaults to 50 and has a maximum of 200. | | `page_token` | string | An identifier that specifies which page of data to return. This value should be taken from the `next_cursor` response body field. |  # /me/ syntax for API calls  The Nylas API v3 Beta includes new `/me/` syntax that you can use in access-token authorized API calls, instead of specifying a user's Grant ID (for example, `GET /v3/grants/me/messages`).  The `/me/` syntax looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  For more information, see the [API v3 Beta features and changes documentation](https:///docs/v3-beta/features-and-changes/#changing-account_id-to-grant_id).  # Metadata  You can add key-value pairs to certain objects to store data against them. You can currently create, read, update, and delete metadata on Calendars and Events. Metadata is coming soon for message drafts and messages.  The `metadata` object is made of a list of key-value pairs. Keys and values can be any string.  Nylas also reserves five specific keys that you can include in the JSON payload of a query to filter the returned objects.  ## Metadata keys and filtering  Nylas reserves five metadata keys (`key1`, `key2`, `key3`, `key4`, `key5`) and indexes their contents. If you add metadata values to these keys, you can then add a metadata filter to a query so that only items with matching metadata are returned. You can also add these filters as URI parameters to a query, as in the examples below.  - `https://api.nylas.com/calendar?metadata_pair=key1:value` - `https://api.nylas.com/events?calendar_id=CALENDAR_ID&metadata_pair=key1:value`  You cannot create a query that contains **both** a provider and metadata filter. Filters like the example below return an error message.  - `https://api.nylas.com/calendar?metadata_pair=key1:value&title=Birthday`\"  You do not need to include an `event_id` when filtering with `metadata_filters`. What's this about? It seems a random  ## Example: Add metadata  The following example cURL request adds metadata to a Calendar. You can add metadata to Calendars and Events using a `POST` request with a `--data-raw` object for both.  In the example below, we add `key1`, which is one of the Nylas-indexed keys that you can use for filtering.  ``` bash curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\ --header 'Content-Type: application/json' \\ --data-raw '{     \"name\" : \"Name of a calendar with metadata\",     \"metadata\":{         \"key1\": \"value to filter on\"     } }'   ```  The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  ## Example: Query metadata  You can query the metadata you added by including a JSON object like the example below to a query that would return metadata-enabled objects. At this time calendars and events support metadata.  ``` json \"metadata\": {     \"key1\": \"value\" }   ```  ### Example: Update and delete metadata  The example cURL command below creates a new Calendar that includes metadata.  ``` bash curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\ --data-raw '{     \"metadata\": {         \"key1\": \"Initial metadata value\"     } }'   ```  The example below updates the calendar `metadata` using a `PUT` command.  **Note**: The `PUT` command overwrites the entire `metadata` object. (The `PATCH` command behaves in the same way, and overwrites the entire `metadata` object.)  ``` bash curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\ --data-raw '{     \"metadata\": {         \"key1\": \"This key has been updated\",         \"key2\": \"Added this new key\"     } }'   ```  The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  The response will be similar to the following example. Is this Nylas' response confirming the change? Or is this the response if you query for that metadata later?  ``` json \"metadata\": {     \"key1\": \"This key has been updated\",     \"key2\": \"Added this new key\" }   ```  If you update the above example with the `PUT` call below that does _not_ include both metadata keys, Nylas deletes `key2` from the `metadata` object.  ``` bash curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\ --data-raw '{     \"metadata\": {         \"key1\": \"New Value\"     } }'   ```  The response will then be similar to the example below. Same question re: what kind of response.  ``` json \"metadata\": {     \"key1\": \"New Value\" }   ```
 *
 * The version of the OpenAPI document: 1.0.0
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.8.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace JackWH\NylasV3\EmailCalendar;

/**
 * HeaderSelector Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class HeaderSelector
{
    /**
     * @param string[] $accept
     * @param string   $contentType
     * @param bool     $isMultipart
     * @return string[]
     */
    public function selectHeaders(array $accept, string $contentType, bool $isMultipart): array
    {
        $headers = [];

        $accept = $this->selectAcceptHeader($accept);
        if ($accept !== null) {
            $headers['Accept'] = $accept;
        }

        if (!$isMultipart) {
            if($contentType === '') {
                $contentType = 'application/json';
            }

            $headers['Content-Type'] = $contentType;
        }

        return $headers;
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided.
     *
     * @param string[] $accept Array of header
     *
     * @return null|string Accept (e.g. application/json)
     */
    private function selectAcceptHeader(array $accept): ?string
    {
        # filter out empty entries
        $accept = array_filter($accept);

        if (count($accept) === 0) {
            return null;
        }

        # If there's only one Accept header, just use it
        if (count($accept) === 1) {
            return reset($accept);
        }

        # If none of the available Accept headers is of type "json", then just use all them
        $headersWithJson = preg_grep('~(?i)^(application/json|[^;/ \t]+/[^;/ \t]+[+]json)[ \t]*(;.*)?$~', $accept);
        if (count($headersWithJson) === 0) {
            return implode(',', $accept);
        }

        # If we got here, then we need add quality values (weight), as described in IETF RFC 9110, Items 12.4.2/12.5.1,
        # to give the highest priority to json-like headers - recalculating the existing ones, if needed
        return $this->getAcceptHeaderWithAdjustedWeight($accept, $headersWithJson);
    }

    /**
    * Create an Accept header string from the given "Accept" headers array, recalculating all weights
    *
    * @param string[] $accept            Array of Accept Headers
    * @param string[] $headersWithJson   Array of Accept Headers of type "json"
    *
    * @return string "Accept" Header (e.g. "application/json, text/html; q=0.9")
    */
    private function getAcceptHeaderWithAdjustedWeight(array $accept, array $headersWithJson): string
    {
        $processedHeaders = [
            'withApplicationJson' => [],
            'withJson' => [],
            'withoutJson' => [],
        ];

        foreach ($accept as $header) {

            $headerData = $this->getHeaderAndWeight($header);

            if (stripos($headerData['header'], 'application/json') === 0) {
                $processedHeaders['withApplicationJson'][] = $headerData;
            } elseif (in_array($header, $headersWithJson, true)) {
                $processedHeaders['withJson'][] = $headerData;
            } else {
                $processedHeaders['withoutJson'][] = $headerData;
            }
        }

        $acceptHeaders = [];
        $currentWeight = 1000;

        $hasMoreThan28Headers = count($accept) > 28;

        foreach($processedHeaders as $headers) {
            if (count($headers) > 0) {
                $acceptHeaders[] = $this->adjustWeight($headers, $currentWeight, $hasMoreThan28Headers);
            }
        }

        $acceptHeaders = array_merge(...$acceptHeaders);

        return implode(',', $acceptHeaders);
    }

    /**
     * Given an Accept header, returns an associative array splitting the header and its weight
     *
     * @param string $header "Accept" Header
     *
     * @return array with the header and its weight
     */
    private function getHeaderAndWeight(string $header): array
    {
        # matches headers with weight, splitting the header and the weight in $outputArray
        if (preg_match('/(.*);\s*q=(1(?:\.0+)?|0\.\d+)$/', $header, $outputArray) === 1) {
            $headerData = [
                'header' => $outputArray[1],
                'weight' => (int)($outputArray[2] * 1000),
            ];
        } else {
            $headerData = [
                'header' => trim($header),
                'weight' => 1000,
            ];
        }

        return $headerData;
    }

    /**
     * @param array[] $headers
     * @param float   $currentWeight
     * @param bool    $hasMoreThan28Headers
     * @return string[] array of adjusted "Accept" headers
     */
    private function adjustWeight(array $headers, float &$currentWeight, bool $hasMoreThan28Headers): array
    {
        usort($headers, function (array $a, array $b) {
            return $b['weight'] - $a['weight'];
        });

        $acceptHeaders = [];
        foreach ($headers as $index => $header) {
            if($index > 0 && $headers[$index - 1]['weight'] > $header['weight'])
            {
                $currentWeight = $this->getNextWeight($currentWeight, $hasMoreThan28Headers);
            }

            $weight = $currentWeight;

            $acceptHeaders[] = $this->buildAcceptHeader($header['header'], $weight);
        }

        $currentWeight = $this->getNextWeight($currentWeight, $hasMoreThan28Headers);

        return $acceptHeaders;
    }

    /**
     * @param string $header
     * @param int    $weight
     * @return string
     */
    private function buildAcceptHeader(string $header, int $weight): string
    {
        if($weight === 1000) {
            return $header;
        }

        return trim($header, '; ') . ';q=' . rtrim(sprintf('%0.3f', $weight / 1000), '0');
    }

    /**
     * Calculate the next weight, based on the current one.
     *
     * If there are less than 28 "Accept" headers, the weights will be decreased by 1 on its highest significant digit, using the
     * following formula:
     *
     *    next weight = current weight - 10 ^ (floor(log(current weight - 1)))
     *
     *    ( current weight minus ( 10 raised to the power of ( floor of (log to the base 10 of ( current weight minus 1 ) ) ) ) )
     *
     * Starting from 1000, this generates the following series:
     *
     * 1000, 900, 800, 700, 600, 500, 400, 300, 200, 100, 90, 80, 70, 60, 50, 40, 30, 20, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1
     *
     * The resulting quality codes are closer to the average "normal" usage of them (like "q=0.9", "q=0.8" and so on), but it only works
     * if there is a maximum of 28 "Accept" headers. If we have more than that (which is extremely unlikely), then we fall back to a 1-by-1
     * decrement rule, which will result in quality codes like "q=0.999", "q=0.998" etc.
     *
     * @param int  $currentWeight varying from 1 to 1000 (will be divided by 1000 to build the quality value)
     * @param bool $hasMoreThan28Headers
     * @return int
     */
    public function getNextWeight(int $currentWeight, bool $hasMoreThan28Headers): int
    {
        if ($currentWeight <= 1) {
            return 1;
        }

        if ($hasMoreThan28Headers) {
            return $currentWeight - 1;
        }

        return $currentWeight - 10 ** floor( log10($currentWeight - 1) );
    }
}
