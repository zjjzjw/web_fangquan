<?php namespace App\Src\Developer\Infra\Repository;

use App\Foundation\Domain\Repository;
use App\Src\Developer\Domain\Interfaces\DeveloperInterface;
use App\Src\Developer\Domain\Model\DeveloperEntity;
use App\Src\Developer\Domain\Model\DeveloperSpecification;
use App\Src\Developer\Domain\Model\DeveloperStatus;
use App\Src\Developer\Infra\Eloquent\DeveloperModel;

class DeveloperRepository extends Repository implements DeveloperInterface
{
    /**
     * Store an entity into persistence.
     *
     * @param  DeveloperEntity $developer_entity
     */
    protected function store($developer_entity)
    {
        if ($developer_entity->isStored()) {
            $model = DeveloperModel::find($developer_entity->id);
        } else {
            $model = new DeveloperModel();
        }
        $model->fill(
            [
                'name'              => $developer_entity->name,
                'logo'              => $developer_entity->logo,
                'status'            => $developer_entity->status,
                'rank'              => $developer_entity->rank,
                'principles'        => $developer_entity->principles,
                'developer_address' => $developer_entity->developer_address,
                'decision'          => $developer_entity->decision,
                'city_id'           => $developer_entity->city_id,
                'province_id'       => $developer_entity->province_id,
            ]
        );
        $model->save();
        if (!empty($developer_entity->developer_category)) {
            $model->developer_category()->sync($developer_entity->developer_category);
        }
        $developer_entity->setIdentity($model->id);
    }

    /**
     * Reconstitute an entity from persistence.
     *
     * @param       $id
     * @param array $params
     *
     * @return DeveloperEntity|null
     */
    protected function reconstitute($id, $params = [])
    {
        $model = DeveloperModel::find($id);
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }

    /**
     * @param $model
     * @return DeveloperEntity
     */
    private function reconstituteFromModel($model)
    {
        $entity = new DeveloperEntity();
        $entity->id = $model->id;
        $entity->name = $model->name;
        $entity->logo = $model->logo;
        $entity->status = $model->status;
        $entity->rank = $model->rank;
        $entity->decision = $model->decision;
        $entity->developer_address = $model->developer_address;
        $entity->principles = $model->principles;
        $entity->province_id = $model->province_id;
        $entity->city_id = $model->city_id;
        $entity->developer_category = $model->developer_category()->pluck('category_id')->toArray();
        $entity->created_at = $model->created_at;
        $entity->updated_at = $model->updated_at;
        $entity->setIdentity($model->id);
        $entity->stored();
        return $entity;
    }


    /**
     * @param DeveloperSpecification $spec
     * @param int                    $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(DeveloperSpecification $spec, $per_page = 10)
    {
        $builder = DeveloperModel::query();

        if ($spec->keyword) {
            $builder->where('name', 'like', '%' . $spec->keyword . '%');
        }
        if ($spec->status) {
            $builder->where('status', $spec->status);
        }
        if ($spec->province_id) {
            $builder->where('province_id', $spec->province_id);
        }

        if ($spec->city_id) {
            $builder->where('city_id', $spec->city_id);
        }

        if ($spec->page) {
            $paginator = $builder->paginate($per_page, ['*'], 'page', $spec->page);
        } else {
            $paginator = $builder->paginate($per_page);
        }

        foreach ($paginator as $key => $model) {
            $paginator[$key] = $this->reconstituteFromModel($model)->stored();
        }

        return $paginator;
    }

    /**
     * @param int|array $ids
     */
    public function delete($ids)
    {
        $builder = DeveloperModel::query();
        $builder->whereIn('id', (array)$ids);
        $models = $builder->get();
        foreach ($models as $model) {
            $developer_categorys = $model->developer_category()->pluck('developer_id')->toArray();
            if (!empty($developer_categorys)) {
                $model->developer_category()->detach($developer_categorys);
            }
            $model->delete();
        }
    }


    /**
     * @param $rank
     * @param $status
     * @return array|\Illuminate\Support\Collection
     */
    public function getDeveloperByRankAndStatus($rank, $status)
    {
        $collection = collect();
        $builder = DeveloperModel::query();
        $builder->where('rank', $rank);
        $builder->where('status', $status);
        $models = $builder->get();
        foreach ($models as $model) {
            $collection[] = $this->reconstituteFromModel($model);
        }
        return $collection;
    }


    public function geHotDeveloperList()
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->where(['status' => DeveloperStatus::YES]);
        $builder->orderByDesc('rank');
        $builder->limit(10);
        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }

        return $collect;
    }

    public function getDeveloperListMore($skip, $limit)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->where(['status' => DeveloperStatus::YES]);
        $builder->orderByDesc('rank');
        if ($skip) {
            $builder->skip($skip);
        }
        if ($limit) {
            $builder->limit($limit);
        }
        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }

        return $collect;
    }

    /**
     * @param int|array $status
     * @return array|\Illuminate\Support\Collection
     */
    public function getAllDeveloperList($status)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->where('status', (array)$status);
        $builder->orderBy('rank', 'asc');
        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param int|array $name
     * @return array|\Illuminate\Support\Collection
     */
    public function getDeveloperListByName($name)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->where('name', $name);
        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param string $keyword
     * @return array|\Illuminate\Support\Collection
     */
    public function getDeveloperByKeyword($keyword)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->where('name', 'like', '%' . $keyword . '%');
        $builder->limit(10);
        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param array $ids
     * @return array|\Illuminate\Support\Collection
     */
    public function getDevelopersByIds($ids)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->whereIn('id', (array)$ids);
        $builder->orderByRaw('FIELD(id,' . implode(',', $ids) . ')');

        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }


    public function getDevelopersByCategoryIds($category_ids)
    {
        $collect = collect();
        $builder = DeveloperModel::query();
        $builder->leftJoin('developer_category', function ($join) {
            $join->on('developer_category.developer_id', '=', 'developer.id');
        });
        $builder->whereIn('developer_category.category_id', (array)$category_ids);
        $builder->select('developer.*');
        $builder->distinct();

        $models = $builder->get();
        /** @var DeveloperModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @return int
     */
    public function getDeveloperCount()
    {
        $builder = DeveloperModel::query();
        $builder->where('status', DeveloperStatus::YES);
        return $builder->count();
    }

}