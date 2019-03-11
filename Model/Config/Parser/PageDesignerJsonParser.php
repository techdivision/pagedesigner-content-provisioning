<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @author    Vadim Justus <v.justus@techdivision.com>
 * @copyright 2019 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-cli-simple
 * @link      http://www.techdivision.com
 */

declare(strict_types=1);

namespace TechDivision\PageDesignerContentProvisioning\Model\Config\Parser;

use DOMElement;
use Firegento\ContentProvisioning\Api\ConfigParserInterface;
use Firegento\ContentProvisioning\Model\Config\Parser\Query\FetchAttributeValue;
use Firegento\ContentProvisioning\Model\Resolver\ContentResolverProvider;
use Magenerds\PageDesigner\Constants;
use Magento\Framework\Exception\LocalizedException;

class PageDesignerJsonParser implements ConfigParserInterface
{
    /**
     * @var ContentResolverProvider
     */
    private $contentResolverProvider;

    /**
     * @var FetchAttributeValue
     */
    private $fetchAttributeValue;

    /**
     * @param ContentResolverProvider $contentResolverProvider
     * @param FetchAttributeValue $fetchAttributeValue
     */
    public function __construct(
        ContentResolverProvider $contentResolverProvider,
        FetchAttributeValue $fetchAttributeValue
    ) {
        $this->contentResolverProvider = $contentResolverProvider;
        $this->fetchAttributeValue = $fetchAttributeValue;
    }

    /**
     * @param DOMElement $element
     * @return array
     * @throws LocalizedException
     */
    public function execute(DOMElement $element): array
    {
        $jsonNodes = $element->getElementsByTagName('page_designer_json');
        if ($jsonNodes->length > 0) {
            $jsonNode = $jsonNodes->item(0);

            $type = $this->fetchAttributeValue->execute($jsonNode, 'type', 'plain');
            $contentResolver = $this->contentResolverProvider->get($type);

            return [
                Constants::ATTR_PAGE_DESIGNER_JSON => $contentResolver->execute($jsonNode)
            ];
        }

        return [];
    }
}
