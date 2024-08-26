# Claim Transaction API

## Endpoint

`POST /api/claim_transaction`

## Description

This endpoint allows the user to claim a specific transaction by providing its unique identifier. The user must be authenticated using a Bearer token to access this endpoint.

## Request

### Method

`POST`

### URL

`/api/claim_transaction`

### Headers

| Key            | Value               |
|----------------|---------------------|
| Content-Type   | application/json    |
| Authorization  | Bearer {access_token} |

#### Authorization

This endpoint requires a Bearer token obtained during the login process. The token must be included in the `Authorization` header.

### Request Body

The request body should contain a JSON object with the ID of the transaction to be claimed.

```json
{
    "id": 1
}
