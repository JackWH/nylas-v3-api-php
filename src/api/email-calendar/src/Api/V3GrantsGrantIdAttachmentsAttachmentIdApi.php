<?php
/**
 * V3GrantsGrantIdAttachmentsAttachmentIdApi
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

namespace JackWH\NylasV3\EmailCalendar\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use JackWH\NylasV3\EmailCalendar\ApiException;
use JackWH\NylasV3\EmailCalendar\Configuration;
use JackWH\NylasV3\EmailCalendar\HeaderSelector;
use JackWH\NylasV3\EmailCalendar\ObjectSerializer;

/**
 * V3GrantsGrantIdAttachmentsAttachmentIdApi Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class V3GrantsGrantIdAttachmentsAttachmentIdApi
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @var Configuration
     */
    protected Configuration $config;

    /**
     * @var HeaderSelector
     */
    protected HeaderSelector $headerSelector;

    /**
     * @var int Host index
     */
    protected int $hostIndex;

    /** @var string[] * */
    public const contentTypes = [
        'downloadAnAttachment' => [
            'application/json',
        ],
        'returnMetadataOfAnAttachment' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface|null $client
     * @param Configuration|null   $config
     * @param HeaderSelector|null  $selector
     * @param int                  $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig(): Configuration
    {
        return $this->config;
    }

    /**
     * Operation downloadAnAttachment
     *
     * Download an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['downloadAnAttachment'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return string|object|object
     */
    public function downloadAnAttachment(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['downloadAnAttachment'][0]
    ): string {
        list($response) = $this->downloadAnAttachmentWithHttpInfo($grant_id, $attachment_id, $accept, $message_id, $contentType);

        return $response;
    }

    /**
     * Operation downloadAnAttachmentWithHttpInfo
     *
     * Download an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['downloadAnAttachment'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of string|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function downloadAnAttachmentWithHttpInfo(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['downloadAnAttachment'][0]
    ): array {
        $request = $this->downloadAnAttachmentRequest($grant_id, $attachment_id, $accept, $message_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('string', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('string' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'string', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = 'string';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'string',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation downloadAnAttachmentAsync
     *
     * Download an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['downloadAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadAnAttachmentAsync(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['downloadAnAttachment'][0]
    ): PromiseInterface {
        return $this->downloadAnAttachmentAsyncWithHttpInfo($grant_id, $attachment_id, $accept, $message_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation downloadAnAttachmentAsyncWithHttpInfo
     *
     * Download an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['downloadAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function downloadAnAttachmentAsyncWithHttpInfo(
        $grant_id,
        $attachment_id,
        $accept = null,
        $message_id = null,
        string $contentType = self::contentTypes['downloadAnAttachment'][0]
    ): PromiseInterface {
        $returnType = 'string';
        $request = $this->downloadAnAttachmentRequest($grant_id, $attachment_id, $accept, $message_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'downloadAnAttachment'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['downloadAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function downloadAnAttachmentRequest(
        $grant_id,
        $attachment_id,
        $accept = null,
        $message_id = null,
        string $contentType = self::contentTypes['downloadAnAttachment'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling downloadAnAttachment'
            );
        }

        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling downloadAnAttachment'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/attachments/{attachment_id}/download';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $message_id,
            'message_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }
        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachment_id' . '}',
                ObjectSerializer::toPathValue($attachment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['text/plain', 'application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation returnMetadataOfAnAttachment
     *
     * Return metadata of an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['returnMetadataOfAnAttachment'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return object|object|object
     */
    public function returnMetadataOfAnAttachment(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['returnMetadataOfAnAttachment'][0]
    ): object {
        list($response) = $this->returnMetadataOfAnAttachmentWithHttpInfo($grant_id, $attachment_id, $accept, $message_id, $contentType);

        return $response;
    }

    /**
     * Operation returnMetadataOfAnAttachmentWithHttpInfo
     *
     * Return metadata of an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['returnMetadataOfAnAttachment'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of object|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function returnMetadataOfAnAttachmentWithHttpInfo(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['returnMetadataOfAnAttachment'][0]
    ): array {
        $request = $this->returnMetadataOfAnAttachmentRequest($grant_id, $attachment_id, $accept, $message_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = 'object';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation returnMetadataOfAnAttachmentAsync
     *
     * Return metadata of an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['returnMetadataOfAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function returnMetadataOfAnAttachmentAsync(
        string $grant_id,
        string $attachment_id,
        ?string $accept = null,
        ?string $message_id = null,
        string $contentType = self::contentTypes['returnMetadataOfAnAttachment'][0]
    ): PromiseInterface {
        return $this->returnMetadataOfAnAttachmentAsyncWithHttpInfo($grant_id, $attachment_id, $accept, $message_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation returnMetadataOfAnAttachmentAsyncWithHttpInfo
     *
     * Return metadata of an Attachment
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['returnMetadataOfAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function returnMetadataOfAnAttachmentAsyncWithHttpInfo(
        $grant_id,
        $attachment_id,
        $accept = null,
        $message_id = null,
        string $contentType = self::contentTypes['returnMetadataOfAnAttachment'][0]
    ): PromiseInterface {
        $returnType = 'object';
        $request = $this->returnMetadataOfAnAttachmentRequest($grant_id, $attachment_id, $accept, $message_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'returnMetadataOfAnAttachment'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $attachment_id (Required) ID of the attachment to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $message_id (Required) ID of the message the attachment belongs to. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['returnMetadataOfAnAttachment'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function returnMetadataOfAnAttachmentRequest(
        $grant_id,
        $attachment_id,
        $accept = null,
        $message_id = null,
        string $contentType = self::contentTypes['returnMetadataOfAnAttachment'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling returnMetadataOfAnAttachment'
            );
        }

        // verify the required parameter 'attachment_id' is set
        if ($attachment_id === null || (is_array($attachment_id) && count($attachment_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $attachment_id when calling returnMetadataOfAnAttachment'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/attachments/{attachment_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $message_id,
            'message_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }
        // path params
        if ($attachment_id !== null) {
            $resourcePath = str_replace(
                '{' . 'attachment_id' . '}',
                ObjectSerializer::toPathValue($attachment_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (! $options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
