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
use Firegento\ContentProvisioning\Api\Data\EntryInterface;
use Firegento\ContentProvisioning\Model\Config\Parser\Query\FetchAttributeValue;
use Firegento\ContentProvisioning\Model\Config\Parser\Query\FetchMediaFilesChain;
use Firegento\ContentProvisioning\Model\Resolver\ContentResolverProvider;
use Magenerds\PageDesigner\Constants;
use Magento\Framework\Exception\LocalizedException;
use TechDivision\PageDesignerContentProvisioning\Model\Config\Parser\Query\FetchEncodedContents;

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
     * @var FetchEncodedContents
     */
    private $fetchEncodedContents;

    /**
     * @var FetchMediaFilesChain
     */
    private $fetchMediaFilesChain;

    /**
     * @param ContentResolverProvider $contentResolverProvider
     * @param FetchAttributeValue $fetchAttributeValue
     * @param FetchEncodedContents $fetchEncodedContents
     * @param FetchMediaFilesChain $fetchMediaFilesChain
     */
    public function __construct(
        ContentResolverProvider $contentResolverProvider,
        FetchAttributeValue $fetchAttributeValue,
        FetchEncodedContents $fetchEncodedContents,
        FetchMediaFilesChain $fetchMediaFilesChain
    ) {
        $this->contentResolverProvider = $contentResolverProvider;
        $this->fetchAttributeValue = $fetchAttributeValue;
        $this->fetchEncodedContents = $fetchEncodedContents;
        $this->fetchMediaFilesChain = $fetchMediaFilesChain;
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
            $json = $contentResolver->execute($jsonNode);

            return [
                Constants::ATTR_PAGE_DESIGNER_JSON => $json,
                EntryInterface::MEDIA_FILES => $this->fetchMediaFiles($json)
            ];
        }

        return [];
    }

    /**
     * @param string $content
     * @return array
     * @throws LocalizedException
     */
    private function fetchMediaFiles(string $content): array
    {
        $result = [];
        $encodedContents = $this->fetchEncodedContents->execute($content);
        foreach ($encodedContents as $encodedContent) {
            $decodedContent = base64_decode($encodedContent);

            $result[] = $this->fetchMediaFilesChain->execute($decodedContent);
        }

        return array_merge(...$result);
    }
}
