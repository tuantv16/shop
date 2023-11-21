<?php

namespace App\Repositories\Traits;

use App\Models\BaseModel;
use Cache;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

trait MasterTrait
{
    /**
     * @describe get all items
     *
     * @param int $parentId
     * @return mixed
     */
    public function getItems(int $parentId = 0): mixed
    {
        $query = $this->model->where('parent_id', $parentId);
        return $query->orderBy('disp_order')->paginate();
    }

    /**
     * @param $level
     * @param $parent
     * @return int
     */
    public function getMaxDispOrderByLevelAndParent($level, $parent): int
    {
        try {
            return $this->model->where('level', $level)->where('parent_id', $parent)->max('disp_order');
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * @return mixed
     */
    public function getItemsDisplayWithParent(): mixed
    {

        $table = $this->model->getTable();
      
        $key = $this->model->getKeyName();
        $cacheKey = $table . '_display_with_parent';

        return Cache::remember($cacheKey, 60 * 60 * 24, function () use ($table, $key) {
            return $this->model
                ->select([
                    "{$table}.{$key}",
                    "{$table}.name",
                    "{$table}.parent_id",
                    "{$table}.seo_url",
                    "parent_table.name as parent_name",
                    "parent_table.seo_url as parent_seo_url",
                ])
                ->leftJoin("{$table} as parent_table", "parent_table.{$key}", '=', "{$table}.parent_id")
                ->where("{$table}.disp", BaseModel::DISPLAY)
                ->orderBy("{$table}.disp_order")
                ->get();
        });
    }

    /**
     * @describe get items by ids
     *
     * @param $ids
     * @return mixed
     */
    public function getItemByIds($ids): mixed
    {
        $table = $this->model->getTable();
        $key = $this->model->getKeyName();
        $cacheKey = $table . '_popular_display';
        return Cache::remember($cacheKey, 60 * 60 * 24, function () use ($table, $key, $ids) {
            return $this->model->whereIn($key, $ids)->where('disp', BaseModel::DISPLAY)->orderBy('disp_order')->get();
        });
    }

    /**
     * @describe get root display
     * @return mixed
     */
    public function getRootDisplay(): mixed
    {
        $table = $this->model->getTable();
        $cacheKey = $table . '_root_display';
        return Cache::remember($cacheKey, 60 * 60 * 24, function () use ($table) {
            return $this->model->where('disp', BaseModel::DISPLAY)->where(
                'parent_id',
                BaseModel::ROOT_PARENT_ID
            )->orderBy('disp_order')->get();
        });
    }

    /**
     * @param array $attributes
     * @param $id
     * @return LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws ValidatorException
     */
    public function update(array $attributes, $id): mixed
    {
        $this->clearCache();
        return parent::update($attributes, $id);
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws ValidatorException
     */
    public function create(array $attributes): mixed
    {
        $this->clearCache();
        return parent::create($attributes);
    }

    /**
     * @return void
     */
    private function clearCache(): void
    {
        $table = $this->model->getTable();
        Cache::forget($table . '_display_with_parent');
        Cache::forget($table . '_popular_display');
        Cache::forget($table . '_root_display');
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        $this->clearCache();
        return parent::delete($id);
    }
    
    /**
     * @param $areaId
     * @return int
     */
    public function getDataAreaIds($areaId)
    {
        $relatedAreaIds = [];
        $currentAreaIds = [$areaId];
        while (!empty($currentAreaIds)) {
            // Lấy ra các area_id con của area_id hiện tại
            $childAreaIds = DB::table('m_areas')
                ->whereIn('parent_id', $currentAreaIds)
                ->pluck('area_id')
                ->toArray();
            
            $relatedAreaIds = array_merge($relatedAreaIds, $childAreaIds);
    
            $currentAreaIds = $childAreaIds;
        }
    
        array_push($relatedAreaIds, $areaId);
        return $relatedAreaIds;
       
    }

}
