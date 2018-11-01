<?php

return [
    'films' => [
        'name' => 'required',
        'description' => 'required',
        'release_date' => 'required|date',
        'rating' => 'required|integer|min:1|max:5',
        'ticket_price' => 'required',
        'country' => 'required',
        'genre' => 'required',
        'photo' => 'required|mimes:jpeg,jpg,gif,bmp,png',
    ]
];