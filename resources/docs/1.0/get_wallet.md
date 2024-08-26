# Get Wallet Information API

## Endpoint

`GET /api/get_wallet`

## Description

This endpoint retrieves the wallet information for the authenticated user. The wallet information includes the current balance, the count of unclaimed transactions, and the pending balance. The user must be authenticated using a Bearer token to access this endpoint.

## Request

### Method

`GET`

### URL

`/api/get_wallet`

### Headers

| Key            | Value               |
|----------------|---------------------|
| Content-Type   | application/json    |
| Authorization  | Bearer {access_token} |

#### Authorization

This endpoint requires a Bearer token obtained during the login process. The token must be included in the `Authorization` header.

## Response

### Success Response

If the request is successful, the API will return the wallet information in the following JSON structure:

```json
{
    "wallet": {
        "balance": "0.00",
        "unclaimedTransactionsCount": 1,
        "pendingBalance": 0.05
    }
}
