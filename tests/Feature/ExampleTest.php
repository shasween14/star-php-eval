<?php

it('redirects the home page to the article list', function () {
    $this->get('/')->assertRedirect('/articles');
});

it('shows the article list page', function () {
    $this->get('/articles')->assertOk();
});
