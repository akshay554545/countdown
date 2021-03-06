<?php

namespace Magesture\CountDown\Model\Category;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
    protected function getFieldsMap()
    {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'featured_product_countdown_release_date';

        return $fields;
    }
}