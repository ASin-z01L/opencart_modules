<?php

class ControllerExtensionModuleUsort extends Controller
{
    private $error = array();

    public function index()
    {
        $extension = 'extension/';

        $this->load->language($extension . 'module/usort');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $defaultSort = 'p.sort_order;ASC';
            $sortNotDefault = array_diff($this->request->post['sort'], array($defaultSort));

            $this->load->model('setting/setting');

            if (!empty($sortNotDefault)) {
                $this->model_setting_setting->editSetting('usort', array('usort_sort_in_category' => $sortNotDefault));
            } else {
                $this->model_setting_setting->deleteSetting('usort');
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link($extension . 'extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($extension . 'module/usort', 'user_token=' . $this->session->data['user_token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($extension . 'module/usort', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
            );
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['sort'])) {
            $data['sort'] = $this->request->post['sort'];
        } elseif ($this->config->get('usort_sort_in_category')) {
            $data['sort'] = $this->config->get('usort_sort_in_category');
        } else {
            $data['sort'] = '';
        }

        $data['action'] = $this->url->link($extension . 'module/usort', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link($extension . 'extension', 'user_token=' . $this->session->data['user_token'], true);

        $this->load->model('catalog/category');

        $categories = $this->model_catalog_category->getCategories();
        $data['categories'] = $categories;

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view($extension . 'module/usort', $data));
    }

    protected function validate()
    {
        $extension = 'extension/';

        if (!$this->user->hasPermission('modify', $extension . 'module/usort')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {
        $this->load->model('extension/usort');
        $this->model_extension_usort->createTable();

        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('module_usort', [
            'module_usort_status' => 1
        ]);

    }

    public function uninstall() {
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('module_usort');
        $this->model_setting_setting->deleteSetting('usort');

        $this->load->model('extension/usort');
        $this->model_extension_usort->dropTable();
    }
}