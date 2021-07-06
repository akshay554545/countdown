<?php

namespace Magesture\CountDown\Ui\Component\Listing\Column;

class MailStatus implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [['value' => 0, 'label' => __('No')],
        ['value' => 1, 'label' => __('Yes')]
        ];
    }
}
