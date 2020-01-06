<?php

namespace App\Repositories;

use App\Models\Swing;
use App\Repositories\BaseRepository;

/**
 * Class SwingRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:19 pm UTC
*/

class SwingRepository extends BaseRepository
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
        return Swing::class;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function searchBrokenVideos($search = [], $dateAnalyzed, $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    if (is_array($value) && $value[0] instanceof \Datetime) {
                        $query->where($key, $value[1], $value[0]->format('Y-m-d H:i:s.v'));
                    } elseif (is_array($value)) {
                        $query->whereIn($key, $value);
                    } else {
                        $query->where($key, $value);
                    }
                }
            }
        }
        //join type 2 with type 3
        $query->where(function($q) use ($dateAnalyzed) {
            $q->orWhere('DateAnalyzed', '>=', $dateAnalyzed);
            $q->orWhereNull('DateAnalyzed');
            return $q;
        });

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get($columns);
    }

}
