# OpenAPIClient-php

<div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Administration APIs</strong> only. See the <strong><a href=\"/docs/api/v3/ecc/\">Email, Calendar, and Contacts API reference</a></strong> for information on working with the Email, Calendar, and Contacts APIs.</div>

The **Nylas Administration APIs** are how you query and change your Nylas applications, including the application's authentication configuration, provider settings, and webhook subscriptions. You can also use Administration APIs to query your application to list the Grants (specific permissions to access user data) that are associated with each of your Nylas applications.

The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html).

You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas APIs. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).

## Query parameters

Nylas allows you to include query parameters in `GET` requests that return a list of results. Query parameters let you narrow the results Nylas returns, meaning fewer requests to the provider and less data for your application to sift through. For more information, see [Rate limits in Nylas](/docs/dev-guide/platform/rate-limits/).

The table below shows the query parameters you can use for the `GET` requests in the Administration APIs.

| Endpoint | Query parameters |
| :--- | :--- |
| [`GET /v3/connectors`](/docs/api/v3/admin/#get-/v3/connectors) | `limit`, `offset` |
| [`GET /v3/grants`](/docs/api/v3/admin/#get-/v3/grants) | `limit`, `offset`, `sort_by`, `order_by`, `since`, `before`, `email`, `grant_status`, `ip`, `provider` |
| [`GET /v3/connectors/<PROVIDER>/creds`](/docs/api/v3/admin/#get-/v3/connectors/-provider-/creds) | `limit`, `offset`, `sort_by`, `order_by` |

You can use the `limit` parameter to set the maximum number of results Nylas returns for your request. Nylas recommends setting a lower `limit` if you encounter rate limits on the provider. For more information, see [Avoiding rate limits in Nylas](/docs/dev-guide/best-practices/rate-limits/).

## Updating objects

`PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.

Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.

## Authentication documentation

You can find more information about the Nylas Administration APIs in the main documentation set:

- [Authentication in v3](/docs/v3/auth/)
  - [Create grants with OAuth authentication + API key](/docs/v3/auth/hosted-oauth-apikey/)
  - [Create grants with OAuth authentication + Access token](/docs/v3/auth/hosted-oauth-accesstoken/)
  - [Create grants with custom authentication](/docs/v3/auth/custom/) (called \"native\" authentication in v2)
  - [Create grants with IMAP authentication](/docs/v3/auth/imap/)
- [Bulk authentication in v3](/docs/v3/auth/bulk-auth-grants/)
- [v3 event codes](/docs/v3/api-references/event-codes/)
- [Virtual Calendars in v3](/docs/v3/auth/virtual-calendars/)

## Nylas v3 encoding

Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.


For more information, please visit [https://www.nylas.com/](https://www.nylas.com/).

## Installation & Usage

### Requirements

PHP 8.1 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure Bearer (API key) authorization: NYLAS_API_KEY
$config = JackWH\NylasV3\Administration\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\Administration\Api\ApplicationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = array('key' => new \JackWH\NylasV3\Administration\Model\UNKNOWN_BASE_TYPE()); // \JackWH\NylasV3\Administration\Model\UNKNOWN_BASE_TYPE | 

try {
    $result = $apiInstance->addApplicationRedirectUri($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ApplicationsApi->addApplicationRedirectUri: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ApplicationsApi* | [**addApplicationRedirectUri**](docs/Api/ApplicationsApi.md#addapplicationredirecturi) | **POST** /v3/applications/redirect-uris | Add callback URI to application
*ApplicationsApi* | [**deleteApplicationRedirectUriById**](docs/Api/ApplicationsApi.md#deleteapplicationredirecturibyid) | **DELETE** /v3/applications/redirect-uris/{id} | Delete a callback URI
*ApplicationsApi* | [**getApplication**](docs/Api/ApplicationsApi.md#getapplication) | **GET** /v3/applications | Get application
*ApplicationsApi* | [**getApplicationRedirectUriAll**](docs/Api/ApplicationsApi.md#getapplicationredirecturiall) | **GET** /v3/applications/redirect-uris | Get an application&#39;s callback URIs
*ApplicationsApi* | [**getApplicationRedirectUriById**](docs/Api/ApplicationsApi.md#getapplicationredirecturibyid) | **GET** /v3/applications/redirect-uris/{id} | Get callback URI
*ApplicationsApi* | [**patchApplicationRedirectUriById**](docs/Api/ApplicationsApi.md#patchapplicationredirecturibyid) | **PATCH** /v3/applications/redirect-uris/{id} | Update a callback URI
*ApplicationsApi* | [**updateApplication**](docs/Api/ApplicationsApi.md#updateapplication) | **PATCH** /v3/applications | Update an application
*AuthenticationAPIsApi* | [**customAuthFlow**](docs/Api/AuthenticationAPIsApi.md#customauthflow) | **POST** /v3/connect/custom | Custom Authentication
*AuthenticationAPIsApi* | [**exchangeOauth2Token**](docs/Api/AuthenticationAPIsApi.md#exchangeoauth2token) | **POST** /v3/connect/token | Hosted OAuth - Token exchange
*AuthenticationAPIsApi* | [**getOauth2Flow**](docs/Api/AuthenticationAPIsApi.md#getoauth2flow) | **GET** /v3/connect/auth | Hosted OAuth - Authorization Request
*AuthenticationAPIsApi* | [**infoOauth2Token**](docs/Api/AuthenticationAPIsApi.md#infooauth2token) | **GET** /v3/connect/tokeninfo | OAuth Token Info
*AuthenticationAPIsApi* | [**revokeOauth2TokenAndGrant**](docs/Api/AuthenticationAPIsApi.md#revokeoauth2tokenandgrant) | **POST** /v3/connect/revoke | Hosted OAuth - Revoke OAuth token
*ConnectorCredentialsApi* | [**createCredential**](docs/Api/ConnectorCredentialsApi.md#createcredential) | **POST** /v3/connectors/{provider}/creds | Create a credential
*ConnectorCredentialsApi* | [**deleteCredentialById**](docs/Api/ConnectorCredentialsApi.md#deletecredentialbyid) | **DELETE** /v3/connectors/{provider}/creds/{id} | Delete credential
*ConnectorCredentialsApi* | [**getCredentialAll**](docs/Api/ConnectorCredentialsApi.md#getcredentialall) | **GET** /v3/connectors/{provider}/creds | List credentials
*ConnectorCredentialsApi* | [**getCredentialById**](docs/Api/ConnectorCredentialsApi.md#getcredentialbyid) | **GET** /v3/connectors/{provider}/creds/{id} | Get credential
*ConnectorCredentialsApi* | [**patchCredentialById**](docs/Api/ConnectorCredentialsApi.md#patchcredentialbyid) | **PATCH** /v3/connectors/{provider}/creds/{id} | Update a connector credential
*ConnectorsIntegrationsApi* | [**createConnector**](docs/Api/ConnectorsIntegrationsApi.md#createconnector) | **POST** /v3/connectors | Create a connector
*ConnectorsIntegrationsApi* | [**deleteConnectorByProvider**](docs/Api/ConnectorsIntegrationsApi.md#deleteconnectorbyprovider) | **DELETE** /v3/connectors/{provider} | Delete a connector
*ConnectorsIntegrationsApi* | [**detectProviderByEmail**](docs/Api/ConnectorsIntegrationsApi.md#detectproviderbyemail) | **POST** /v3/providers/detect | Detect provider
*ConnectorsIntegrationsApi* | [**getConnectorAll**](docs/Api/ConnectorsIntegrationsApi.md#getconnectorall) | **GET** /v3/connectors | List connectors
*ConnectorsIntegrationsApi* | [**getConnectorByProvider**](docs/Api/ConnectorsIntegrationsApi.md#getconnectorbyprovider) | **GET** /v3/connectors/{provider} | Get connector
*ConnectorsIntegrationsApi* | [**updateConnectorByProvider**](docs/Api/ConnectorsIntegrationsApi.md#updateconnectorbyprovider) | **PATCH** /v3/connectors/{provider} | Update a connector
*ManageGrantsApi* | [**customAuthFlow**](docs/Api/ManageGrantsApi.md#customauthflow) | **POST** /v3/connect/custom | Custom Authentication
*ManageGrantsApi* | [**deleteGrantById**](docs/Api/ManageGrantsApi.md#deletegrantbyid) | **DELETE** /v3/grants/{grantId} | Delete a grant
*ManageGrantsApi* | [**getGrantAll**](docs/Api/ManageGrantsApi.md#getgrantall) | **GET** /v3/grants | List grants
*ManageGrantsApi* | [**getGrantByAccessToken**](docs/Api/ManageGrantsApi.md#getgrantbyaccesstoken) | **GET** /v3/grants/me | Get current grant
*ManageGrantsApi* | [**getGrantById**](docs/Api/ManageGrantsApi.md#getgrantbyid) | **GET** /v3/grants/{grantId} | Get a grant
*ManageGrantsApi* | [**patchGrantById**](docs/Api/ManageGrantsApi.md#patchgrantbyid) | **PATCH** /v3/grants/{grantId} | Update a grant
*PubSubNotificationsApi* | [**createPubsubChannel**](docs/Api/PubSubNotificationsApi.md#createpubsubchannel) | **POST** /v3/channels/pubsub | Create a Pub/Sub channel
*PubSubNotificationsApi* | [**deletePubsubById**](docs/Api/PubSubNotificationsApi.md#deletepubsubbyid) | **DELETE** /v3/channels/pubsub/{id} | Delete a specific Pub/Sub channel
*PubSubNotificationsApi* | [**getMockWebhookPayload**](docs/Api/PubSubNotificationsApi.md#getmockwebhookpayload) | **POST** /v3/webhooks/mock-payload | Get mock notification payload
*PubSubNotificationsApi* | [**getPubsubById**](docs/Api/PubSubNotificationsApi.md#getpubsubbyid) | **GET** /v3/channels/pubsub/{id} | Get a specific Pub/Sub channel
*PubSubNotificationsApi* | [**getPubsubChannels**](docs/Api/PubSubNotificationsApi.md#getpubsubchannels) | **GET** /v3/channels/pubsub | Get Pub/Sub channels for an application
*PubSubNotificationsApi* | [**putPubsubById**](docs/Api/PubSubNotificationsApi.md#putpubsubbyid) | **PUT** /v3/channels/pubsub/{id} | Update a Pub/Sub channel
*WebhookNotificationsApi* | [**deleteWebhookById**](docs/Api/WebhookNotificationsApi.md#deletewebhookbyid) | **DELETE** /v3/webhooks/{id} | Delete a webhook destination
*WebhookNotificationsApi* | [**getMockWebhookPayload**](docs/Api/WebhookNotificationsApi.md#getmockwebhookpayload) | **POST** /v3/webhooks/mock-payload | Get mock notification payload
*WebhookNotificationsApi* | [**getWebhookById**](docs/Api/WebhookNotificationsApi.md#getwebhookbyid) | **GET** /v3/webhooks/{id} | Get the destinations for an application by webhook ID
*WebhookNotificationsApi* | [**getWebhookDestinationsApplication**](docs/Api/WebhookNotificationsApi.md#getwebhookdestinationsapplication) | **GET** /v3/webhooks | Get destinations for an application
*WebhookNotificationsApi* | [**postNewSecret**](docs/Api/WebhookNotificationsApi.md#postnewsecret) | **POST** /v3/webhooks/rotate-secret/{id} | Rotate a webhook secret
*WebhookNotificationsApi* | [**postWebhookDestinations**](docs/Api/WebhookNotificationsApi.md#postwebhookdestinations) | **POST** /v3/webhooks | Create a webhook destination
*WebhookNotificationsApi* | [**putWebhookById**](docs/Api/WebhookNotificationsApi.md#putwebhookbyid) | **PUT** /v3/webhooks/{id} | Update a webhook destination
*WebhookNotificationsApi* | [**sendTestEvent**](docs/Api/WebhookNotificationsApi.md#sendtestevent) | **POST** /v3/webhooks/send-test-event | Send test event

## Models

- [AddApplicationRedirectUri200Response](docs/Model/AddApplicationRedirectUri200Response.md)
- [AdminConsent](docs/Model/AdminConsent.md)
- [AndroidCallbackwSettings](docs/Model/AndroidCallbackwSettings.md)
- [AndroidCallbackwSettingsSettings](docs/Model/AndroidCallbackwSettingsSettings.md)
- [ApplicationObject](docs/Model/ApplicationObject.md)
- [AutodetectObject](docs/Model/AutodetectObject.md)
- [ConnectorObject](docs/Model/ConnectorObject.md)
- [ConnectorOverride](docs/Model/ConnectorOverride.md)
- [CreateConnector201Response](docs/Model/CreateConnector201Response.md)
- [CreateConnector201ResponseData](docs/Model/CreateConnector201ResponseData.md)
- [CreateConnectorRequest](docs/Model/CreateConnectorRequest.md)
- [CreateCredential201Response](docs/Model/CreateCredential201Response.md)
- [CreateCredentialRequest](docs/Model/CreateCredentialRequest.md)
- [CreatePubsubChannel200Response](docs/Model/CreatePubsubChannel200Response.md)
- [CreatePubsubChannel200ResponseData](docs/Model/CreatePubsubChannel200ResponseData.md)
- [CreatePubsubChannel400Response](docs/Model/CreatePubsubChannel400Response.md)
- [CreatePubsubChannel400ResponseError](docs/Model/CreatePubsubChannel400ResponseError.md)
- [CredentialObject](docs/Model/CredentialObject.md)
- [CustomAuthFlow201Response](docs/Model/CustomAuthFlow201Response.md)
- [CustomAuthFlow201ResponseData](docs/Model/CustomAuthFlow201ResponseData.md)
- [CustomAuthFlowRequest](docs/Model/CustomAuthFlowRequest.md)
- [CustomAuthFlowRequestOneOf](docs/Model/CustomAuthFlowRequestOneOf.md)
- [CustomAuthFlowRequestOneOf1](docs/Model/CustomAuthFlowRequestOneOf1.md)
- [CustomAuthFlowRequestOneOf1Settings](docs/Model/CustomAuthFlowRequestOneOf1Settings.md)
- [CustomAuthFlowRequestOneOf2](docs/Model/CustomAuthFlowRequestOneOf2.md)
- [CustomAuthFlowRequestOneOf2Settings](docs/Model/CustomAuthFlowRequestOneOf2Settings.md)
- [CustomAuthFlowRequestOneOf3](docs/Model/CustomAuthFlowRequestOneOf3.md)
- [CustomAuthFlowRequestOneOf3Settings](docs/Model/CustomAuthFlowRequestOneOf3Settings.md)
- [CustomAuthFlowRequestOneOf4](docs/Model/CustomAuthFlowRequestOneOf4.md)
- [CustomAuthFlowRequestOneOf4Settings](docs/Model/CustomAuthFlowRequestOneOf4Settings.md)
- [CustomAuthFlowRequestOneOf5](docs/Model/CustomAuthFlowRequestOneOf5.md)
- [CustomAuthFlowRequestOneOf5Settings](docs/Model/CustomAuthFlowRequestOneOf5Settings.md)
- [CustomAuthFlowRequestOneOf6](docs/Model/CustomAuthFlowRequestOneOf6.md)
- [CustomAuthFlowRequestOneOf6Settings](docs/Model/CustomAuthFlowRequestOneOf6Settings.md)
- [CustomAuthFlowRequestOneOf7](docs/Model/CustomAuthFlowRequestOneOf7.md)
- [CustomAuthFlowRequestOneOf7Settings](docs/Model/CustomAuthFlowRequestOneOf7Settings.md)
- [CustomAuthFlowRequestOneOf8](docs/Model/CustomAuthFlowRequestOneOf8.md)
- [CustomAuthFlowRequestOneOf8Settings](docs/Model/CustomAuthFlowRequestOneOf8Settings.md)
- [CustomAuthFlowRequestOneOfSettings](docs/Model/CustomAuthFlowRequestOneOfSettings.md)
- [Data](docs/Model/Data.md)
- [Data1](docs/Model/Data1.md)
- [Data2](docs/Model/Data2.md)
- [DeleteApplicationRedirectUriById200Response](docs/Model/DeleteApplicationRedirectUriById200Response.md)
- [DeleteCredentialById200Response](docs/Model/DeleteCredentialById200Response.md)
- [DeleteWebhookById200Response](docs/Model/DeleteWebhookById200Response.md)
- [DeleteWebhookById200ResponseData](docs/Model/DeleteWebhookById200ResponseData.md)
- [DestinationInputPayload](docs/Model/DestinationInputPayload.md)
- [DestinationPayload](docs/Model/DestinationPayload.md)
- [DestinationPayload1](docs/Model/DestinationPayload1.md)
- [DestinationUpdatePayload](docs/Model/DestinationUpdatePayload.md)
- [DetectProviderByEmail200Response](docs/Model/DetectProviderByEmail200Response.md)
- [DetectProviderByEmail200ResponseData](docs/Model/DetectProviderByEmail200ResponseData.md)
- [ExchangeCode](docs/Model/ExchangeCode.md)
- [ExchangeOauth2TokenRequest](docs/Model/ExchangeOauth2TokenRequest.md)
- [GetApplication200Response](docs/Model/GetApplication200Response.md)
- [GetApplication200ResponseData](docs/Model/GetApplication200ResponseData.md)
- [GetApplication200ResponseDataBranding](docs/Model/GetApplication200ResponseDataBranding.md)
- [GetApplication200ResponseDataHostedAuthentication](docs/Model/GetApplication200ResponseDataHostedAuthentication.md)
- [GetApplication400Response](docs/Model/GetApplication400Response.md)
- [GetApplication400ResponseError](docs/Model/GetApplication400ResponseError.md)
- [GetApplication401Response](docs/Model/GetApplication401Response.md)
- [GetApplication401ResponseError](docs/Model/GetApplication401ResponseError.md)
- [GetApplicationRedirectUriAll200Response](docs/Model/GetApplicationRedirectUriAll200Response.md)
- [GetApplicationRedirectUriAll400Response](docs/Model/GetApplicationRedirectUriAll400Response.md)
- [GetApplicationRedirectUriAll404Response](docs/Model/GetApplicationRedirectUriAll404Response.md)
- [GetConnectorAll200Response](docs/Model/GetConnectorAll200Response.md)
- [GetConnectorAll200ResponseDataInner](docs/Model/GetConnectorAll200ResponseDataInner.md)
- [GetConnectorByProvider200Response](docs/Model/GetConnectorByProvider200Response.md)
- [GetCredentialAll200Response](docs/Model/GetCredentialAll200Response.md)
- [GetCredentialAll200ResponseDataInner](docs/Model/GetCredentialAll200ResponseDataInner.md)
- [GetGrantAll200Response](docs/Model/GetGrantAll200Response.md)
- [GetGrantAll200ResponseDataInner](docs/Model/GetGrantAll200ResponseDataInner.md)
- [GetGrantById200Response](docs/Model/GetGrantById200Response.md)
- [GetMockPayloadInput](docs/Model/GetMockPayloadInput.md)
- [GetMockWebhookPayload200Response](docs/Model/GetMockWebhookPayload200Response.md)
- [GetMockWebhookPayload200ResponseData](docs/Model/GetMockWebhookPayload200ResponseData.md)
- [GetPubsubById200Response](docs/Model/GetPubsubById200Response.md)
- [GetPubsubById200ResponseData](docs/Model/GetPubsubById200ResponseData.md)
- [GetPubsubChannels200Response](docs/Model/GetPubsubChannels200Response.md)
- [GetPubsubChannels200ResponseDataInner](docs/Model/GetPubsubChannels200ResponseDataInner.md)
- [GetPubsubChannels400Response](docs/Model/GetPubsubChannels400Response.md)
- [GetPubsubChannels400ResponseError](docs/Model/GetPubsubChannels400ResponseError.md)
- [GetWebhookById200Response](docs/Model/GetWebhookById200Response.md)
- [GetWebhookById200ResponseData](docs/Model/GetWebhookById200ResponseData.md)
- [GetWebhookDestinationsApplication200Response](docs/Model/GetWebhookDestinationsApplication200Response.md)
- [GetWebhookDestinationsApplication200ResponseDataInner](docs/Model/GetWebhookDestinationsApplication200ResponseDataInner.md)
- [GetWebhookDestinationsApplication400Response](docs/Model/GetWebhookDestinationsApplication400Response.md)
- [GetWebhookDestinationsApplication400ResponseError](docs/Model/GetWebhookDestinationsApplication400ResponseError.md)
- [Google](docs/Model/Google.md)
- [GoogleSettings](docs/Model/GoogleSettings.md)
- [GrantObject](docs/Model/GrantObject.md)
- [ICloud](docs/Model/ICloud.md)
- [IMAP](docs/Model/IMAP.md)
- [InfoOauth2Token200Response](docs/Model/InfoOauth2Token200Response.md)
- [InfoOauth2Token200ResponseData](docs/Model/InfoOauth2Token200ResponseData.md)
- [InputPayload](docs/Model/InputPayload.md)
- [InputPayload1](docs/Model/InputPayload1.md)
- [IosCallbackwSettings](docs/Model/IosCallbackwSettings.md)
- [IosCallbackwSettingsSettings](docs/Model/IosCallbackwSettingsSettings.md)
- [JsCallbackwSettings](docs/Model/JsCallbackwSettings.md)
- [JsCallbackwSettingsSettings](docs/Model/JsCallbackwSettingsSettings.md)
- [Microsoft](docs/Model/Microsoft.md)
- [MicrosoftExchangeEWS](docs/Model/MicrosoftExchangeEWS.md)
- [MicrosoftSettings](docs/Model/MicrosoftSettings.md)
- [Model400](docs/Model/Model400.md)
- [Model401](docs/Model/Model401.md)
- [Model404](docs/Model/Model404.md)
- [PatchCredentialByIdRequest](docs/Model/PatchCredentialByIdRequest.md)
- [PatchGrantByIdRequest](docs/Model/PatchGrantByIdRequest.md)
- [PostNewSecret200Response](docs/Model/PostNewSecret200Response.md)
- [PostNewSecret200ResponseData](docs/Model/PostNewSecret200ResponseData.md)
- [PostWebhookDestinations200Response](docs/Model/PostWebhookDestinations200Response.md)
- [PostWebhookDestinations200ResponseData](docs/Model/PostWebhookDestinations200ResponseData.md)
- [PostWebhookDestinations400Response](docs/Model/PostWebhookDestinations400Response.md)
- [PostWebhookDestinations400ResponseError](docs/Model/PostWebhookDestinations400ResponseError.md)
- [PubsubInputPayload](docs/Model/PubsubInputPayload.md)
- [PutPubsubById200Response](docs/Model/PutPubsubById200Response.md)
- [PutPubsubById200ResponseData](docs/Model/PutPubsubById200ResponseData.md)
- [PutPubsubById400Response](docs/Model/PutPubsubById400Response.md)
- [PutPubsubById400ResponseError](docs/Model/PutPubsubById400ResponseError.md)
- [PutPubsubByIdRequest](docs/Model/PutPubsubByIdRequest.md)
- [PutWebhookById200Response](docs/Model/PutWebhookById200Response.md)
- [PutWebhookById200ResponseData](docs/Model/PutWebhookById200ResponseData.md)
- [PutWebhookById400Response](docs/Model/PutWebhookById400Response.md)
- [PutWebhookById400ResponseError](docs/Model/PutWebhookById400ResponseError.md)
- [RedirectURIObject](docs/Model/RedirectURIObject.md)
- [RefreshAccessToken](docs/Model/RefreshAccessToken.md)
- [SendTestEvent200Response](docs/Model/SendTestEvent200Response.md)
- [SendTestEventInput](docs/Model/SendTestEventInput.md)
- [ServiceAccount](docs/Model/ServiceAccount.md)
- [UpdateApplication200Response](docs/Model/UpdateApplication200Response.md)
- [UpdateApplication400Response](docs/Model/UpdateApplication400Response.md)
- [UpdateApplication400ResponseError](docs/Model/UpdateApplication400ResponseError.md)
- [UpdateApplication404Response](docs/Model/UpdateApplication404Response.md)
- [UpdateApplication404ResponseError](docs/Model/UpdateApplication404ResponseError.md)
- [UpdateConnectorByProviderRequest](docs/Model/UpdateConnectorByProviderRequest.md)
- [VirtualCalendars](docs/Model/VirtualCalendars.md)
- [WebDesktopCallbackNoSettings](docs/Model/WebDesktopCallbackNoSettings.md)
- [Yahoo](docs/Model/Yahoo.md)
- [YahooSettings](docs/Model/YahooSettings.md)
- [Zoom](docs/Model/Zoom.md)
- [ZoomSettings](docs/Model/ZoomSettings.md)

## Authorization

### ACCESS_TOKEN

- **Type**: Bearer authentication (Access token)


### NYLAS_API_KEY

- **Type**: Bearer authentication (API key)

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v3`
    - Generator version: `7.8.0`
- Build package: `org.openapitools.codegen.languages.PhpNextgenClientCodegen`
