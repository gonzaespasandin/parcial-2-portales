<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Obtener las compras del usuario
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'user_id', 'id');
    }

    /**
     * Verificar si el usuario ya compró un producto específico
     */
    public function hasPurchasedProduct(int $productId): bool
    {
        return $this->purchases->contains(function($purchase) use ($productId) {
            return $purchase->product_id_fk == $productId;
        });
    }

    /**
     * Verificar si el usuario compró el juego base
     */
    public function hasGame(): bool
    {
        return $this->hasPurchasedProduct(1);
    }

    /**
     * Verificar si el usuario compró complementos
     */
    public function hasComplements(): bool
    {
        return $this->purchases->contains(function($purchase) {
            return $purchase->product_id_fk != 1;
        });
    }

    /**
     * Obtener la fecha de la última compra
     */
    public function getLastPurchaseDate(): string
    {
        $lastPurchase = $this->purchases->sortByDesc('purchased_at')->first();
        return $lastPurchase ? $lastPurchase->purchased_at->format('d/m/Y') : 'Sin compras';
    }
}
