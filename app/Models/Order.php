<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Order extends Model
    {
        protected $fillable = [
            'user_id',
            'name',
            'email',
            'phone',
            'address',
            'comment',
            'amount',
            'status',
        ];

        public const STATUSES = [
            0 => 'Новый',
            1 => 'Собирается',
            2 => 'Оплачен',
            3 => 'Передан на доставку',
            4 => 'Выполнен',
        ];

        public function items()
        {
            return $this->hasMany(OrderItem::class);
        }
    }
