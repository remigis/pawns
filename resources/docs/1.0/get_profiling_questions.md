# Get Profiling Questions API

## Endpoint

`GET /api/get_profiling_questions`

## Description

This endpoint retrieves a list of profiling questions used to gather user information. The user must be authenticated using a Bearer token to access this endpoint.

## Request

### Method

`GET`

### URL

`/api/get_profiling_questions`

### Headers

| Key            | Value               |
|----------------|---------------------|
| Content-Type   | application/json    |
| Authorization  | Bearer {access_token} |

#### Authorization

This endpoint requires a Bearer token obtained during the login process. The token must be included in the `Authorization` header.

## Response

### Success Response

If the request is successful, the API will return a list of profiling questions in the following JSON structure:

```json
{
    "questions": [
        {
            "id": 1,
            "text": "What is your gender?",
            "type": "single_choice",
            "options": [
                "Male",
                "Female"
            ]
        },
        {
            "id": 2,
            "text": "What is your date of birth?",
            "type": "date",
            "options": null
        }
    ]
}
