<?php


namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function threadLikes()
    {
        return $this->hasMany(ThreadLike::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }
    public function threadDislikes()
    {
        return $this->hasMany(ThreadDislike::class);
    }

    public function commentDislikes()
    {
        return $this->hasMany(CommentDislike::class);
    }

}
