<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-usort" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
                   class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body" style="font-size:16px;">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-usort"
                      class="form-horizontal">
                    <div class="form-group hidden-xs">
                        <div class="col-sm-3"><strong><?php echo $text_title_sort; ?></strong></div>
                        <div class="col-sm-9"><strong><?php echo $text_title_category; ?></strong></div>
                    </div>

                    <?php foreach($categories as $key => $category) { ?>
                        <?php $sortInCategory = isset($sort[$category['category_id']]) ? $sort[$category['category_id']] : '' ?>
                        <div class="form-group"
                        <?php echo ($key % 2 == 0) ? 'style="background-color:#efefef"' : ''; ?>>
                            <div class="col-sm-9 col-sm-push-3">
                                <div style="line-height: 35px;">
                                    <?php echo $category['name'] ?>
                                </div>
                            </div>
                            <div class="col-sm-3 col-sm-pull-9">
                                <select name="sort[<?php echo $category['category_id'] ?>]" class="form-control">
                                    <option value="p.sort_order;ASC"><?php echo $text_option_sort_order_asc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'pd.name;ASC') ? 'selected' : '' ?>
                                    value="pd.name;ASC"><?php echo $text_option_name_asc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'pd.name;DESC') ? 'selected' : '' ?>
                                    value="pd.name;DESC"><?php echo $text_option_name_desc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'p.price;ASC') ? 'selected' : '' ?>
                                    value="p.price;ASC"><?php echo $text_option_price_asc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'p.price;DESC') ? 'selected' : '' ?>
                                    value="p.price;DESC"><?php echo $text_option_price_desc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'rating;ASC') ? 'selected' : '' ?>
                                    value="rating;ASC"><?php echo $text_option_rating_asc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'rating;DESC') ? 'selected' : '' ?>
                                    value="rating;DESC"><?php echo $text_option_rating_desc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'p.model;ASC') ? 'selected' : '' ?>
                                    value="p.model;ASC"><?php echo $text_option_model_asc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'p.model;DESC') ? 'selected' : '' ?>
                                    value="p.model;DESC"><?php echo $text_option_model_desc; ?></option>
                                    <option
                                    <?php echo ($sortInCategory == 'us.sort_cat;ASC') ? 'selected' : '' ?>
                                    value="us.sort_cat;ASC"><?php echo $text_option_sort_cat_asc; ?></option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>