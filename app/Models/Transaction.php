<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Transaction
 * @package App
 *
 * @property-read int $id
 * @property-read \DateTime $created_at
 * @property-read \DateTime $updated_at
 * @property int $user_id
 * @property string $operation
 * @property float $amount
 * @property-read User $user
 *
 */
class Transaction extends Model
{
    public const OPERATION_ADD = 'add';
    public const OPERATION_DEDUCT = 'deduct';
    public const OPERATIONS = [self::OPERATION_ADD, self::OPERATION_DEDUCT];


    protected $fillable = [
        'user_id', 'amount'
    ];

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        \DB::transaction(function () {
            /** @var User $user */
            $user = resolve(User::class)->find($this->user_id);
            if ($this->operation === self::OPERATION_DEDUCT) {
                if ($this->amount > $user->balance) {
                    throw new \Exception('User balance less then transaction amount', 400);
                }
                $user->balance -= $this->amount;
            } else {
                $user->balance += $this->amount;
            }

            $this->save();
            $user->save();
        });
    }
}
