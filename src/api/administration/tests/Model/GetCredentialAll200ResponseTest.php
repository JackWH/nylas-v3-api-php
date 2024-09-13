<?php
/**
 * GetCredentialAll200ResponseTest
 *
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\Administration
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Nylas v3 Administration APIs
 *
 * <div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Administration APIs</strong> only. See the <strong><a href=\"/docs/api/v3/ecc/\">Email, Calendar, and Contacts API reference</a></strong> for information on working with the Email, Calendar, and Contacts APIs.</div>  The **Nylas Administration APIs** are how you query and change your Nylas applications, including the application's authentication configuration, provider settings, and webhook subscriptions. You can also use Administration APIs to query your application to list the Grants (specific permissions to access user data) that are associated with each of your Nylas applications.  The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html).  You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas APIs. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).  ## Query parameters  Nylas allows you to include query parameters in `GET` requests that return a list of results. Query parameters let you narrow the results Nylas returns, meaning fewer requests to the provider and less data for your application to sift through. For more information, see [Rate limits in Nylas](/docs/dev-guide/platform/rate-limits/).  The table below shows the query parameters you can use for the `GET` requests in the Administration APIs.  | Endpoint | Query parameters | | :--- | :--- | | [`GET /v3/connectors`](/docs/api/v3/admin/#get-/v3/connectors) | `limit`, `offset` | | [`GET /v3/grants`](/docs/api/v3/admin/#get-/v3/grants) | `limit`, `offset`, `sort_by`, `order_by`, `since`, `before`, `email`, `grant_status`, `ip`, `provider` | | [`GET /v3/connectors/<PROVIDER>/creds`](/docs/api/v3/admin/#get-/v3/connectors/-provider-/creds) | `limit`, `offset`, `sort_by`, `order_by` |  You can use the `limit` parameter to set the maximum number of results Nylas returns for your request. Nylas recommends setting a lower `limit` if you encounter rate limits on the provider. For more information, see [Avoiding rate limits in Nylas](/docs/dev-guide/best-practices/rate-limits/).  ## Updating objects  `PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.  Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.  ## Authentication documentation  You can find more information about the Nylas Administration APIs in the main documentation set:  - [Authentication in v3](/docs/v3/auth/)   - [Create grants with OAuth authentication + API key](/docs/v3/auth/hosted-oauth-apikey/)   - [Create grants with OAuth authentication + Access token](/docs/v3/auth/hosted-oauth-accesstoken/)   - [Create grants with custom authentication](/docs/v3/auth/custom/) (called \"native\" authentication in v2)   - [Create grants with IMAP authentication](/docs/v3/auth/imap/) - [Bulk authentication in v3](/docs/v3/auth/bulk-auth-grants/) - [v3 event codes](/docs/v3/api-references/event-codes/) - [Virtual Calendars in v3](/docs/v3/auth/virtual-calendars/)  ## Nylas v3 encoding  Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.
 *
 * The version of the OpenAPI document: v3
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.8.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Please update the test case below to test the model.
 */

namespace JackWH\NylasV3\Administration\Test\Model;

use PHPUnit\Framework\TestCase;

/**
 * GetCredentialAll200ResponseTest Class Doc Comment
 *
 * @description GetCredentialAll200Response
 * @package     JackWH\NylasV3\Administration
 * @author      OpenAPI Generator team
 * @link        https://openapi-generator.tech
 */
class GetCredentialAll200ResponseTest extends TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test "GetCredentialAll200Response"
     */
    public function testGetCredentialAll200Response()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "request_id"
     */
    public function testPropertyRequestId()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "data"
     */
    public function testPropertyData()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "limit"
     */
    public function testPropertyLimit()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }

    /**
     * Test attribute "offset"
     */
    public function testPropertyOffset()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }
}
