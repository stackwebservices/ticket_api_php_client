# ticket_api_client

API PHP client for http://ticket.stackwebservices.com

## Request URL

http://ticket.stackwebservices.com/api.php

## How to use

```
$api = array();
$api['email'] = 'my@email.com';
$api['secret'] = '1234567890';
$api['organisation_id'] = 1;

$ticket = new sws_ticket_api_client($api['email'], $api['secret'], $api['organisation_id']);
```

**Create a new ticket**

```
$email = 'client@email.com';
$title = 'bug 1';
$message = 'my imac has just crashed and when Iturn it on again all that';

$new_ticket = $ticket->ticket_add($email, $title, $message);
```

**Check ticket status**

```
$email = 'client@email.com';
$ticket_id = 1;

$status = $ticket->ticket_details_check($email, $ticket_id);
```

**Add comment**

```
$email = 'client@email.com';
$ticket_id = 1;
$comment = 'client comment';

$cc = $ticket->comment_add($email, $ticket_id, $comment);
```
