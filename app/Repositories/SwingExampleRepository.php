<?php

namespace App\Repositories;

use App\Models\SwingExample;
use App\Models\SwingExamplePro;
use App\Repositories\BaseRepository;

/**
 * Class SwingExampleRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:19 pm UTC
*/

class SwingExampleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'SwingID',
        'AccountID',
        'SwingStatusID',
        'InstructorID',
        'DateUploaded',
        'DateAnalyzed',
        'Deleted',
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
        return SwingExample::class;
    }
}
