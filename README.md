### Observation:

Class `\App\HttpClientProcessor` is not able to fetch the response content if it has
not been done in the app workflow.

### Reproduce by runnning:

```
git clone git@github.com:B-Galati/symfony_reproducer_34289.git
cd symfony_reproducer_34289
make start
make reproducer
make stop
```

###### Output:

```
^ array:1 [
  "response_content" => ""
]
08:26:41 ERROR     [app] Request with response content unfetched ["exception" => Symfony\Component\HttpClient\Exception\ServerException^ { …},"http_client" => [["response_content" => ""]]]
^ array:1 [
  "response_content" => "{"message":"This is a JSON 500 response"}"
]
08:26:42 ERROR     [app] Request with response content fetched ["exception" => Symfony\Component\HttpClient\Exception\ServerException^ { …},"http_client" => [["response_content" => "{"message":"This is a JSON 500 response"}"]]]
^ array:1 [
  "response_content" => ""
]
```

###### Expected: 

```
^ array:1 [
  "response_content" => "{"message":"This is a JSON 500 response"}"
]
08:26:41 ERROR     [app] Request with response content unfetched ["exception" => Symfony\Component\HttpClient\Exception\ServerException^ { …},"http_client" => [["response_content" => ""]]]
^ array:1 [
  "response_content" => "{"message":"This is a JSON 500 response"}"
]
08:26:42 ERROR     [app] Request with response content fetched ["exception" => Symfony\Component\HttpClient\Exception\ServerException^ { …},"http_client" => [["response_content" => "{"message":"This is a JSON 500 response"}"]]]
^ array:1 [
  "response_content" => "{"message":"This is a JSON 500 response"}"
]
```
