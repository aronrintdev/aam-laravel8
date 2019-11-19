<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\AccountAvatar;
use League\Fractal;

/**
 * @OA\Schema(
 *   schema="avatar",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="AccountAvatarID",
 *     example="123",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="data type (avatar)",
 *     default="avatar",
 *     example="avatar",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="object",
 *       @OA\Property(
 *         property="url",
 *         description="",
 *         example="https://vos-media.nyc3.digitaloceanspaces.com/profile/ab/abcdefg-123.png",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="account_id",
 *         example="123",
 *         type="string"
 *       ),
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
