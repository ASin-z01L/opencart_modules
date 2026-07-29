<?php

class ControllerExtensionModuleShortcodes extends Controller
{
    protected function getLayoutModuleId($entity_id, $entity)
    {
        switch ($entity) {
            case "category":
                $idModule = $this->model_catalog_category->getIdModuleCategory($entity_id);
                break;
            case "product":
                $idModule = $this->model_catalog_product->getIdModuleProduct($entity_id);
                break;
            case "information":
                $idModule = $this->model_catalog_information->getIdModuleInformation($entity_id);
                break;
            default:
                $idModule = '';
        }

        return $idModule;
    }

    public function shortcodesReplace($data)
    {
        list($description, $entity_id, $entity) = $data;

        $idModule = $this->getLayoutModuleId($entity_id, $entity);

        if (!empty($idModule)) {
            // Getting data and name module by id

            $this->load->model('extension/module');

            $shortcodesListJson = $this->model_extension_module->getShortcodesContent($idModule);

            if (!empty($shortcodesListJson)) {

                $shortcodesOut = array();

                foreach ($shortcodesListJson as $item) {
                    $shortcodesListArray = json_decode($item, true);

                    if ($shortcodesListArray['status']) {
                        if (array_key_exists('banner_id', $shortcodesListArray)) {
                            $shortcodesOut[$shortcodesListArray['name']]['html'] =
                                $this->load->controller('extension/module/banner', $shortcodesListArray);
                        } else {
                            $languageId = (int)$this->config->get('config_language_id');

                            if (isset($shortcodesListArray['module_description'][$languageId])) {

                                $shortcodesOut[$shortcodesListArray['name']]['html'] =
                                    html_entity_decode($shortcodesListArray['module_description'][$languageId]['description'], ENT_QUOTES, 'UTF-8');

                            }
                        }
                    }
                }

                foreach ($shortcodesOut as $shortcodes => $content) {
                    $description = str_replace('[' . $shortcodes . ']', $content['html'], $description);
                }
            }
        }

        // Remove shortcodes if module are not found
        return preg_replace('/\[sc_(.*?)]/ui', '', $description);
    }
}