<?php
namespace Magesture\CountDown\Ui\DataProvider\Product\Form\Modifier;

use Magento\Framework\Stdlib\ArrayManager;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

/**
 * Class ScheduleDesignUpdateMetaProvider customizes Schedule Design Update panel
 *
 * @api
 * @since 101.0.0
 */
class PreSellDesignUpdate extends AbstractModifier
{
    /**#@+
     * Field names
     */
    const PRESALE_START = 'presell_start';
    const PRESALE_END = 'presell_end';
    /**#@-*/

    /**
     * @var ArrayManager
     * @since 101.0.0
     */
    protected $arrayManager;

    /**
     * @param ArrayManager $arrayManager
     */
    public function __construct(ArrayManager $arrayManager)
    {
        $this->arrayManager = $arrayManager;
    }

    /**
     * @inheritdoc
     *
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        return $this->customizeDateRangeField($meta);
    }

    /**
     * @inheritdoc
     *
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Customize date range field if from and to fields belong to one group
     *
     * @param array $meta
     * @return array
     * @since 101.0.0
     */
    protected function customizeDateRangeField(array $meta)
    {
        $presale_start = "presale_start";
        $presale_end = "presale_end";
        if ($this->getGroupCodeByField($meta, $presale_start)
            !== $this->getGroupCodeByField($meta, $presale_end)
        ) {
            return $meta;
        }

        $fromFieldPath = $this->arrayManager->findPath($presale_start, $meta, null, 'children');
        $toFieldPath = $this->arrayManager->findPath($presale_end, $meta, null, 'children');
        $fromContainerPath = $this->arrayManager->slicePath($fromFieldPath, 0, -2);
        $toContainerPath = $this->arrayManager->slicePath($toFieldPath, 0, -2);

        $meta = $this->arrayManager->merge(
            $fromFieldPath . self::META_CONFIG_PATH,
            $meta,
            [
                'label' => __('Presell Product From'),
                'additionalClasses' => 'admin__field-date',
            ]
        );
        $meta = $this->arrayManager->merge(
            $toFieldPath . self::META_CONFIG_PATH,
            $meta,
            [
                'label' => __('To'),
                'scopeLabel' => null,
                'additionalClasses' => 'admin__field-date',
            ]
        );
        $meta = $this->arrayManager->merge(
            $fromContainerPath . self::META_CONFIG_PATH,
            $meta,
            [
                'label' => false,
                'required' => false,
                'additionalClasses' => 'admin__control-grouped-date',
                'breakLine' => false,
                'component' => 'Magento_Ui/js/form/components/group',
            ]
        );
        $meta = $this->arrayManager->set(
            $fromContainerPath . '/children/' . self::PRESALE_END,
            $meta,
            $this->arrayManager->get($toFieldPath, $meta)
        );

        return $this->arrayManager->remove($toContainerPath, $meta);
    }
}
