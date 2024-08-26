# Update Profile API

## Endpoint

`POST /api/update_profile`

## Description

This endpoint allows the user to update their profile by submitting answers to profiling questions. The answers should correspond to the questions retrieved from the `/api/get_profiling_questions` endpoint. The user must be authenticated using a Bearer token to access this endpoint.

## Request

### Method

`POST`

### URL

`/api/update_profile`

### Headers

| Key            | Value               |
|----------------|---------------------|
| Content-Type   | application/json    |
| Authorization  | Bearer {access_token} |

#### Authorization

This endpoint requires a Bearer token obtained during the login process. The token must be included in the `Authorization` header.

### Request Body

The request body should contain a JSON object with an array of answers, where each answer corresponds to a profiling question.

```json
{
    "answers": [
        {
            "questionId": 1,
            "answer": ["Male"]
        },
        {
            "questionId": 2,
            "answer": "1992-05-13"
        }
    ]
}
