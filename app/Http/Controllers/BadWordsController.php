<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadWordsController extends Controller
{
    protected $badWords = [
    'kut', 
    'lelijk', 
    'dom',
    'shit', 
    'fuck', 
    'klootzak', 
    'bitch', 
    'hoer', 
    'lul',
    'nazi', 
    'fascist', 
    'racist', 
    'xenofoob',
    'neuken', 
    'pijpen', 
    'beffen', 
    'kontneuken',
    'idioot', 
    'mongool', 
    'debiel', 
    'imbeciel',
    'homo', 
    'lesbo', 
    'trans', 
    'allochtoon'
];


    public function checkForBadWords($text) {
        foreach ($this->badWords as $badWord) {
            if (stripos($text, $badWord) !== false) {
                return true; // Slecht woord gevonden
            }
        }
        return false; // Geen slechte woorden gevonden
    }

    public function checkText(Request $request) {
    $text = $request->input('text');
    $containsBadWords = $this->checkForBadWords($text);

    return response()->json([
        'containsBadWords' => $containsBadWords
    ]);
}
}

