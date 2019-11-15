<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\AccountAvatar;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="account_avatar",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="AccountAvatarID",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="data type (avatar)",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="array",
 *     @OA\Items(
 *       @OA\Property(
 *         property="url",
 *         description="",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="account_id",
 *         description="",
 *         type="string"
 *       ),
 *     )
 *   )
 * )
 */
class AccountAvatarTransformer extends Fractal\TransformerAbstract
{
	public function transform(AccountAvatar $avatar)
	{
        return [
            'id'         => (int) $avatar->AccountAvatarID,
            'type'       => 'avatar',
            'attributes' => [
                'url'        => $avatar->AvatarURL,
                'account_id' => $avatar->AccountID,
            ]
        ];
    }
}
