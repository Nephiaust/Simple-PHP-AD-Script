$body = @{
    username ="testuser"
    password = 'ASamplePassword'
    AuthKey = 'ASuperSecretAPIKey'
}

$url = "https://dc1.domain.com/admgmt/password/"

Invoke-RestMethod -Method 'Post' -Uri $url -Body ($body|ConvertTo-Json) -ContentType "application/json"
