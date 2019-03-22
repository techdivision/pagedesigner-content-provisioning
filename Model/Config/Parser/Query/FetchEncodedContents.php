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

class FetchEncodedContents
{
    /**
     * @param string $content
     * @return array
     */
    public function execute(string $content): array
    {
        if (preg_match_all('/\\"---BASE64---(?P<contents>.*?)\\"/', $content, $matches)) {
            return $matches['contents'];
        }
        return [];
    }
}
