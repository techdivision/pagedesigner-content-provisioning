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

namespace TechDivision\PageDesignerContentProvisioning\Model\Config\Parser\Query;

use Firegento\ContentProvisioning\Api\MediaFilesParserInterface;
use Magento\Framework\Exception\LocalizedException;

class FetchMediaFromEncodedContents implements MediaFilesParserInterface
{
    /**
     * @var MediaFilesParserInterface[]
     */
    private $parsers = [];

    /**
     * @param array $parsers
     * @throws LocalizedException
     */
    public function __construct(
        array $parsers = []
    ) {
        foreach ($parsers as $parserInstance) {
            if (!($parserInstance instanceof MediaFilesParserInterface)) {
                throw new LocalizedException(__(
                    'Parser needs to be instance of %interface',
                    ['interface' => MediaFilesParserInterface::class]
                ));
            }
        }

        $this->parsers = $parsers;
    }

    /**
     * @param string $content
     * @return array
     */
    public function execute(string $content): array
    {
        $media = [];
        foreach ($this->fetchContents($content) as $encodedContent) {
            $decodedContent = base64_decode($encodedContent);
            $media[] = $this->parseMediaFiles($decodedContent);
        }

        return count($media) ? array_merge(...$media) : [];
    }

    /**
     * @param string $content
     * @return array
     */
    private function parseMediaFiles(string $content): array
    {
        $media = [];
        foreach ($this->parsers as $parser) {
            $media[] = $parser->execute($content);
        }

        return count($media) ? array_merge(...$media) : [];
    }

    /**
     * @param string $content
     * @return array
     */
    private function fetchContents(string $content): array
    {
        if (preg_match_all('/\\"---BASE64---(?P<contents>.*?)\\"/', $content, $matches)) {
            return $matches['contents'];
        }
        return [];
    }
}
