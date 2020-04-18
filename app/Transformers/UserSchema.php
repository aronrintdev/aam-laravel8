<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\Instructor;
use App\User;
use Neomerx\JsonApi\Schema\BaseSchema;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;


/**
 * @OA\Schema(
 *   schema="user",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="AccountID",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="user",
 *     default="user",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="object",
 *       @OA\Property(
 *         property="first_name",
 *         description="First Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="last_name",
 *         description="Last Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="profile_pic",
 *         description="Profile Pic URL",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="email",
 *         description="Email",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="account_type",
 *         description="'user' or 'instructor'",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="academy_id",
 *         description="Currently selected academy ID (instructor only)",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="academy_owner",
 *         description="1 or 0 if the instructor is owner of current academy",
 *         type="string"
 *       ),
 *   ),
 *   @OA\Property(
 *     property="relationships",
 *     description="1 or 0 if the instructor is owner of current academy",
 *     type="object",
 *     @OA\Property(
 *       property="academies",
 *       type="object",
 *       @OA\Property(
 *         type="array",
 *         property="data",
 *         @OA\Items(
 *           @OA\Property(
 *             type="string",
 *             property="id",
 *           ),
 *           @OA\Property(
 *             type="string",
 *             property="type",
 *           ),
 *         ),
 *       ),
 *     ),
 *     @OA\Property(
 *       property="owned_academies",
 *       type="object",
 *       description="Academies where instructor IsMaster",
 *       @OA\Property(
 *         type="array",
 *         property="data",
 *         @OA\Items(
 *           @OA\Property(
 *             type="string",
 *             property="id",
 *           ),
 *           @OA\Property(
 *             type="string",
 *             property="type",
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
 */

class UserSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'user';
    }

    public function getId($user): string
    {
        return $user->AccountID;
    }

    /**
     * @inheritdoc
     */
    public function isAddSelfLinkInRelationshipByDefault(string $relationshipName): bool
    {
        return false;
    }


    /**
     * @inheritdoc
     */
    public function isAddRelatedLinkInRelationshipByDefault(string $relationshipName): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getLinks($resource): iterable
    {
		return [];
    }

    public function getAttributes($user, ContextInterface $context): iterable
    {
        $acct = \App\Models\Account::find($user->AccountID);
        $avatarUrl = $acct->avatar ? $acct->avatar->AvatarURL : null;
        return [
            'first_name'    => $user->FirstName,
            'last_name'     => $user->LastName,
            'profile_pic'   => $avatarUrl,
            'email'         => $user->Email,
            'account_type'  => $user->IsInstructor ? 'instructor' : 'user',
            'academy_id'    => $user->AcademyID,
            'academy_owner' => $user->IsMaster,
        ];
    }

    public function getRelationships($user, ContextInterface $context): iterable
    {
        $acct = \App\Models\Account::find($user->AccountID);
        $academies       = $acct->academiesTeaching;
        $academiesMaster = $acct->academiesMaster;

        if ($user->IsInstructor) {
            return [
                'academies' => [
                    self::RELATIONSHIP_DATA          => function() use ($acct){
                        return $acct->academies;
                    },
                    self::RELATIONSHIP_LINKS_SELF    => false,
                    self::RELATIONSHIP_LINKS_RELATED => false,
                ],
                'owned_academies' => [
                    self::RELATIONSHIP_DATA          => function() use ($acct){
                        return $acct->academiesMaster;
                    },
                    self::RELATIONSHIP_LINKS_SELF    => false,
                    self::RELATIONSHIP_LINKS_RELATED => false,
                ],
            ];
        }

        //regular user accounts have no relationships
        return [];
    }
}
