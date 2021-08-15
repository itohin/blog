<?php

declare(strict_types=1);

namespace App\Models;

class Post
{
    private string $title;

    private string $content;

    private string $date;

    public function __construct(string $title, string $content, string $date)
    {
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}