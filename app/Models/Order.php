<?php

    namespace App\Models;

    use DateTimeZone;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

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
            1 => 'Обработан',
            2 => 'Оплачен',
            3 => 'Доставлен',
            4 => 'Завершен',
        ];

        public function items()
        {
            return $this->hasMany(OrderItem::class);
        }
    }
