<?php

class ControllerExtensionModuleUsort extends Controller
{
    private $error = array();

    public function index()
    {
        $extension = (version_compare(VERSION, '2.3.0', '>=')) ? 'extension/' : '';

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

            $this->response->redirect($this->url->link($extension . 'extension', 'token=' . $this->session->data['token'], true));
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link($extension . 'extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($extension . 'module/usort', 'token=' . $this->session->data['token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($extension . 'module/usort', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_title_sort'] = $this->language->get('text_title_sort');
        $data['text_title_category'] = $this->language->get('text_title_category');
        $data['text_option_sort_order_asc'] = $this->language->get('text_option_sort_order_asc');
        $data['text_option_name_asc'] = $this->language->get('text_option_name_asc');
        $data['text_option_name_desc'] = $this->language->get('text_option_name_desc');
        $data['text_option_price_asc'] = $this->language->get('text_option_price_asc');
        $data['text_option_price_desc'] = $this->language->get('text_option_price_desc');
        $data['text_option_rating_asc'] = $this->language->get('text_option_rating_asc');
        $data['text_option_rating_desc'] = $this->language->get('text_option_rating_desc');
        $data['text_option_model_asc'] = $this->language->get('text_option_model_asc');
        $data['text_option_model_desc'] = $this->language->get('text_option_model_desc');
        $data['text_option_sort_cat_asc'] = $this->language->get('text_option_sort_cat_asc');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

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

        $data['action'] = $this->url->link($extension . 'module/usort', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link($extension . 'extension', 'token=' . $this->session->data['token'], true);

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
        $extension = (version_compare(VERSION, '2.3.0', '>=')) ? 'extension/' : '';

        if (!$this->user->hasPermission('modify', $extension . 'module/usort')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {
        $this->load->model('extension/usort');
        $this->model_extension_usort->createTable();
    }

    public function uninstall() {
        $this->load->model('extension/usort');
        $this->model_extension_usort->dropTable();
    }
}