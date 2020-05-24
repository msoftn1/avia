=====

**Ticket system**

_system api:_  

  **/api/v1/flights/add**  
  request:  [name(string), flight_at(timestamp), secret_key(string)]  
  response: [status, flight_id]

  **/api/v1/flights/completed**  
  request: [flight_id, secret_key(string)]  
  response: [status]

  **/api/v1/flights/canceled**  
  request: [flight_id, secret_key(string)]
  response: [status]

_user api:_

  **/api/v1/flights/reservation/to_book**  
  request:  [flight_id, email, callback_url]  
  response: [status, number, seat]

  **/api/v1/flights/reservation/cancel**  
  request:  [number]  
  response: [status]

  **/api/v1/flights/ticket/buy**  
  request: [number:optional, flight_id, email, callback_url]  
  response: [status, number, seat]

  **/api/v1/flights/ticket/return**  
  request: [number]  
  response: [status]


Параметры Request нужно указывать в качестве query string:  
Пример запроса:

/api/v1/flights/add?name=Flight1&flight_at=123456789&secret_key=a1b2c3d4e5f6a1b2c3d4e5f6




