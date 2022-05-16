<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'book_title',
        'author_name',
        'book_description',
        'year_published'
    ];

    public function getId()
    {
        return $this->id;
    }

    public function getBookTitle()
    {
        return $this->book_title;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function getBookDescription()
    {
        return $this->book_description;
    }
    public function getYearPublished()
    {
        return $this->year_published;
    }

    public function setBookTitle($value)
    {
        // UPDATE books SET book_title=':value' WHERE id=$this->id
        $this->book_title = $value;
        return $this->save();
    }

    public function setAuthorName($value)
    {
        // UPDATE books SET author_name=':value' WHERE id=$this->id
        $this->author_name = $value;
        return $this->save();
    }

    public function setBookDescription($value)
    {
        // UPDATE books SET book_description=':value' WHERE id=$this->id
        $this->book_description = $value;
        return $this->save();
    }

    public function setYearPublished($value)
    {
        // UPDATE friends SET year_published=':value' WHERE id=$this->id
        $this->year_published = $value;
        return $this->save();
    }
}
