<?php

namespace App;

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
 *
 */
class Transaction extends Model
{
    public const OPERATION_ADD = 'add';
    public const OPERATION_DEDUCT = 'deduct';
    public const OPERATIONS = [self::OPERATION_ADD, self::OPERATION_DEDUCT];


}
