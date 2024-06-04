<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
      'user_id',
      'order_total',
      'order_status',
      'order_address',
      'order_phone',
   ];

   use HasFactory;
   public function getStatus()
   {
      if ($this->order_status === 0) {
         return 'Đang xác nhận';
      }
      if ($this->order_status === 1) {
         return 'Đã xác nhận';
      }
      if ($this->order_status === 2) {
         return 'Hủy đơn hàng';
      }
   }

   public function listOrderDetail()
   {
      return $this->hasMany(orderDetail::class, 'order_id');
   }

   public function getDate()
   {
      return $this->created_at->format('Y-m-d H:i:s');
   }

   public function getNameUser()
   {
      return $this->belongsTo(User::class, 'user_id');
   }
}
