<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    
    protected $fillable = ['title','author','content'];


    public function getBlogById($id)
    {
        return $this->find($id);
    }

    public function createBlog(array $data)
    {
        return $this->create($data);
    }

    public function updateBlog($id, array $data)
    {
        $blog = $this->find($id);

        if ($blog) {
            return $blog->update($data);
        }

        return false;
    }

    public function deleteBlog($id)
    {
        $blog = $this->find($id);

        if ($blog) {
            return $blog->delete();
        }

        return false;
    }
}
