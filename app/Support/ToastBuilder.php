<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;

class ToastBuilder
{
    public string $id = '';
    public string $variant = 'primary';
    public string $title = '';
    public string $message = '';
    public bool $dismissible = true;
    public int $timeout = 5000;

    public function __construct($id)
    {
        if (empty($id)) {
            $this->id = 'toast-' . uniqid();

            return;
        }

        $this->id = $id;
    }

    public static function make(string $id = ''): static
    {
        return new static($id);
    }

    public function primary(): static
    {
        return $this->variant('primary');
    }

    public function secondary(): static
    {
        return $this->variant('secondary');
    }

    public function success(): static
    {
        return $this->variant('success');
    }

    public function warning(): static
    {
        return $this->variant('warning');
    }

    public function error(): static
    {
        return $this->variant('warning');
    }

    public function variant(string $variant): static
    {
        $this->variant = $variant;

        return $this;
    }

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function message(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function dismissible(bool $dismissible = true): static
    {
        $this->dismissible = $dismissible;

        return $this;
    }

    public function timeout(int $milliseconds): static
    {
        $this->timeout = $milliseconds;

        return $this;
    }

    public function send(): void
    {
        $toasts = Session::get('toasts', []);

        $toasts[] = [
            'id' => $this->id,
            'variant' => $this->variant,
            'title' => $this->title,
            'message' => $this->message,
            'dismissible' => $this->dismissible,
            'timeout' => $this->timeout,
        ];

        Session::flash('toasts', $toasts);
    }
}
