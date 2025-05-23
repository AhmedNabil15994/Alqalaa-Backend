{{' Hello ' . explode(' ',$client->name)[0]}}
{{' login url : '.url(route('client.login'))}}
{{' username : ' . $client->user_name}}
{{' password : ' . optional($client->phone)->phone}}