<?php

namespace App\Service\Brand;


use App\Src\Brand\Domain\Model\SaleChannelType;
use App\Src\Brand\Domain\Model\SaleChannelEntity;
use App\Src\Brand\Domain\Model\SaleChannelSpecification;
use App\Src\Brand\Infra\Eloquent\SaleChannelFileModel;
use App\Src\Brand\Infra\Repository\SaleChannelRepository;
use App\Src\Surport\Domain\Model\ResourceEntity;
use App\Src\Surport\Infra\Repository\ResourceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SaleChannelService
{
    /**
     * @param SaleChannelSpecification $spec
     * @param int                      $per_page
     * @return array
     */
    public function getSaleChannelList(SaleChannelSpecification $spec, $per_page)
    {
        $data = [];
        $sale_channel_repository = new SaleChannelRepository();
        $paginate = $sale_channel_repository->search($spec, $per_page);
        $sale_channel_types = SaleChannelType::acceptableEnums();
        $items = [];
        /**
         * @var int                  $key
         * @var SaleChannelEntity    $sale_channel_entity
         * @var LengthAwarePaginator $paginate
         */
        foreach ($paginate as $key => $sale_channel_entity) {
            $item = $sale_channel_entity->toArray();
            $item['channel_type_name'] = $sale_channel_types[$sale_channel_entity->channel_type] ?? '';
            $items[] = $item;
        }

        $data['paginate'] = $paginate;
        $data['items'] = $items;
        $data['pager']['total'] = $paginate->total();
        $data['pager']['last_page'] = $paginate->lastPage();
        $data['pager']['current_page'] = $paginate->currentPage();
        return $data;

    }

    /**
     * @param $id
     * @return array
     */
    public function getSaleChannelInfo($id)
    {
        $data = [];
        $sale_channel_repository = new SaleChannelRepository();
        /** @var SaleChannelEntity $sale_channel_entity */
        $sale_channel_entity = $sale_channel_repository->fetch($id);
        if (isset($sale_channel_entity)) {
            $data = $sale_channel_entity->toArray();
        }
        return $data;
    }

    /**
     * @param array   $years 年份数据
     * @param integer $brand_id 品牌ID
     * @return array
     */
    public function getSaleChannelListByYear($years, $brand_id)
    {
        $data = [];
        $sale_channel_repository = new SaleChannelRepository();
        $sale_channel_entities = $sale_channel_repository->getSaleChannelByBrandId($brand_id);
        $sale_channel_type = SaleChannelType::acceptableEnums();
        foreach ($years as $key => $value) {
            $data[$value][$sale_channel_type[SaleChannelType::BRAND]] = 0;
            $data[$value][$sale_channel_type[SaleChannelType::PRODUCT]] = 0;
            $data[$value][$sale_channel_type[SaleChannelType::INFORMATION]] = 0;
            /** @var SaleChannelEntity $sale_channel_entity */
            foreach ($sale_channel_entities as $sale_channel_entity) {
                if ($sale_channel_entity->sale_year == $key) {
                    switch ($sale_channel_entity->channel_type) {
                        case SaleChannelType::BRAND:
                            $data[$value][$sale_channel_type[SaleChannelType::BRAND]] += $sale_channel_entity->sale_volume;
                            break;
                        case SaleChannelType::PRODUCT:
                            $data[$value][$sale_channel_type[SaleChannelType::PRODUCT]] += $sale_channel_entity->sale_volume;
                            break;
                        case SaleChannelType::INFORMATION:
                            $data[$value][$sale_channel_type[SaleChannelType::INFORMATION]] += $sale_channel_entity->sale_volume;
                            break;
                    }
                }
            }
        }
        foreach ($data as $k => $v) {
            $data[$k]['总价'] = array_sum($v);
        }
        return $data;
    }

    /**
     * @param integer $brand_id
     * @return  array
     */
    public function getSaleChannelForModify($brand_id)
    {
        $data = [];
        $sale_channel_repository = new SaleChannelRepository();
        $sale_channel_entities = $sale_channel_repository->getSaleChannelByBrandId($brand_id);
        /** @var SaleChannelEntity $sale_channel_entity */
        foreach ($sale_channel_entities as $sale_channel_entity) {
            $data[$sale_channel_entity->sale_year][$sale_channel_entity->channel_type] = $sale_channel_entity->sale_volume;
        }
        return $data;
    }

    public function saveSaleChannelFile($file_id, $provider_id)
    {
        $sale_channel_file_builder = SaleChannelFileModel::query();
        $sale_channel_file_builder->where('provider_id', $provider_id);
        $sale_channel_file_model = $sale_channel_file_builder->first();
        if (!$sale_channel_file_model) {
            $sale_channel_file_model = new SaleChannelFileModel();
        }
        $sale_channel_file_model->file_id = $file_id;
        $sale_channel_file_model->provider_id = $provider_id;
        $sale_channel_file_model->save();
    }

    public function getSaleChannelFile($provider_id)
    {
        $data = [];
        $resource_repository = new ResourceRepository();
        $sale_channel_file_builder = SaleChannelFileModel::query();
        $sale_channel_file_builder->where('provider_id', $provider_id);
        $sale_channel_file_model = $sale_channel_file_builder->first();
        if ($sale_channel_file_model) {
            /** @var ResourceEntity $resource_entity */
            $resource_entity = $resource_repository->fetch($sale_channel_file_model->file_id);
            if (isset($resource_entity)) {
                $certificate_files = [];
                $certificate_file = [];
                $certificate_file['image_id'] = $sale_channel_file_model->file_id;
                $certificate_file['url'] = '/www/images/file.png';
                $certificate_files[] = $certificate_file;
                $data['certificate_files'] = $certificate_files;
                $data['file_url'] = $resource_entity->url;
            }
        }
        return $data;
    }
}

