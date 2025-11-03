<?php
namespace Szalayk\DateHuman;

class DateHuman
{
    protected string $lang;
    protected array $translations;

    public function __construct(string $lang = 'en')
    {
        $this->setLanguage($lang);
    }

    public function setLanguage(string $lang): void
    {
        $file = __DIR__ . "/Lang/{$lang}.php";
        if (!file_exists($file)) {
            throw new \Exception("Language file not found: {$lang}");
        }
        $this->lang = $lang;
        $this->translations = include $file;
    }

    public function diff($time): string
    {
        $timestamp = is_int($time) ? $time : strtotime($time);
        $now = time();
        $diff = $now - $timestamp;
        $future = $diff < 0;
        $diff = abs($diff);

        $t = $this->translations;

        if ($diff < 60) {
            return $future ? $t['soon'] : $t['now'];
        } elseif ($diff < 3600) {
            $mins = floor($diff / 60);
            return sprintf($future ? $t['in_minutes'] : $t['minutes_ago'], $mins);
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return sprintf($future ? $t['in_hours'] : $t['hours_ago'], $hours);
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return sprintf($future ? $t['in_days'] : $t['days_ago'], $days);
        } elseif ($diff < 2592000) {
            $weeks = floor($diff / 604800);
            return sprintf($future ? $t['in_weeks'] : $t['weeks_ago'], $weeks);
        } elseif ($diff < 31536000) {
            $months = floor($diff / 2592000);
            return sprintf($future ? $t['in_months'] : $t['months_ago'], $months);
        } else {
            $years = floor($diff / 31536000);
            return sprintf($future ? $t['in_years'] : $t['years_ago'], $years);
        }
    }
}
