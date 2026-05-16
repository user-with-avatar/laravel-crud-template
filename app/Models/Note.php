<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\NoteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'data', 'author'])]
class Note extends Model
{
    protected $fillable = ['name', 'airline'];
    /** @use HasFactory<NoteFactory> */
    use HasFactory;
}