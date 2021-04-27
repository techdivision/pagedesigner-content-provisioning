# Description

This module extends functionality for module `firegento/magento2-content-provisioning` in order 
provide content for `magenerds/pagedesigner`.

See also following repositories:

* https://github.com/Magenerds/PageDesigner
* https://github.com/magento-hackathon/m2-content-provisioning

## Supported versions matrix

### "master" branch
| PHP | Magento 2.3 | Magento 2.4 |
|:---:|:---:|:---:|
| 7.3   | [![Build Status](https://travis-matrix-badges.herokuapp.com/repos/techdivision/pagedesigner-content-provisioning/branches/master/1)](https://travis-ci.org/techdivision/pagedesigner-content-provisioning) | [![Build Status](https://travis-matrix-badges.herokuapp.com/repos/techdivision/pagedesigner-content-provisioning/branches/master/2)](https://travis-ci.org/techdivision/pagedesigner-content-provisioning) |
| 7.3   | [![Build Status](https://travis-matrix-badges.herokuapp.com/repos/techdivision/pagedesigner-content-provisioning/branches/master/3)](https://travis-ci.org/techdivision/pagedesigner-content-provisioning) | [![Build Status](https://travis-matrix-badges.herokuapp.com/repos/techdivision/pagedesigner-content-provisioning/branches/master/4)](https://travis-ci.org/techdivision/pagedesigner-content-provisioning) |

## Documentation

After installing this module you can provide an additional XML node (`page_designer_json`) for page and block 
entry configurations.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Firegento/ContentProvisioning/etc/content_provisioning.xsd">
    <page key="example.test.1" identifier="example-1" maintained="true" active="true">
        <title>Example Page foo</title>
        <content heading="Example Page test" type="file">TechDivision_ContentProvisioningExamples::Content/example-1.html</content>
        ...
        <page_designer_json type="file">TechDivision_ContentProvisioningExamples::Content/example-1.json</page_designer_json>
    </page>
    
    <block key="example.test.2" identifier="example-2" maintained="true" active="true">
        <title>Test 1</title>
        <content type="file">TechDivision_ContentProvisioningExamples::Content/example-1.html</content>
        <page_designer_json><![CDATA[{
            "version": "1.0.0", 
            "rows": [
                {
                  "columns": [
                    {
                      "gridSize": {
                        "md": 12
                      },
                      "content": "{{widget type=\"Magento\\Catalog\\Block\\Widget\\RecentlyCompared\" uiComponent=\"widget_recently_compared\" page_size=\"5\" show_attributes=\"name,image,price\" show_buttons=\"add_to_cart\" template=\"product/widget/compared/grid.phtml\" type_name=\"Recently Compared Products\"}}",
                      "settings": {}
                    }
                  ],
                  "settings": {}
                },
                {
                  "columns": [
                    {
                      "gridSize": {
                        "md": 12
                      },
                      "content": "{{widget type=\"Magento\\Sales\\Block\\Widget\\Guest\\Form\" template=\"widget/guest/form.phtml\" type_name=\"Orders and Returns\"}}",
                      "settings": {}
                    }
                  ],
                  "settings": {}
                }
            ]
        }]]></page_designer_json>
    </block>
</config>
```
