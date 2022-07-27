<?php
include_once('includes/functions.php');
?>
<section class="content-header">
    <h1>Products /<small><a href="home.php"><i class="fa fa-home"></i> Home</a></small></h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-product.php"><i class="fa fa-plus-square"></i> Add New Product</a>
    </ol>
</section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <form method="POST" id="filter_form" name="filter_form">

                            <div class="form-group col-md-3">
                            </div>
                        </form>
                    </div>
                    
                    <div  class="box-body table-responsive">
                        <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="api-firebase/get-bootstrap-table-data.php?table=products"  data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]'>
                            <thead>
                                <tr>
                                    
                                    <th  data-field="id" data-sortable="true">ID</th>
                                    <th data-field="category_id" data-sortable="true">Category Id</th>
                                    <th  data-field="product_name" data-sortable="true">Product Name</th>
                                    <th  data-field="brand" data-sortable="true"> Brand</th>
                                    <th  data-field="description" data-sortable="true">Description</th>
                                    <th data-field="image">Image</th>
                                    <th  data-field="operate" data-events="actionEvents">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="separator"> </div>
        </div>
    </section>

<script>

    function queryParams_1(p) {
        return {
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
    
</script>