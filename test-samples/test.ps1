$body = @{
    username ="testuser"
    password = 'ASamplePassword'
}

$Key = "ASuperSecretAPIKey"

$url = "https://dc1.domain.com/admgmt/password/$key"

Invoke-RestMethod -Method 'Post' -Uri $url -Body ($body|ConvertTo-Json) -ContentType "application/json"
