<?php

namespace App\Repositories;

use App\Models\AccountAvatar;
use App\Repositories\BaseRepository;

/**
 * Class AccountAvatarRepository
 * @package App\Repositories
 * @version November 13, 2019, 3:29 pm UTC
*/

class AccountAvatarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'AccountID',
        'AvatarURL'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AccountAvatar::class;
    }

    public function findByAccountID($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->select($columns)
          ->where('AccountID', (int)$id)
          ->first();
    }
}
