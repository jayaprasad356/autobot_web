
<section class="content-header">
    <h1>Tyre Products /<small><a href="home.php"><i class="fa fa-home"></i> Home</a></small></h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-tyre_product.php"><i class="fa fa-plus-square"></i> Add New Tyre Product</a>
    </ol>
</section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">
                    
                    <div  class="box-body table-responsive">
                    <table id='users_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=tyre_products" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="false" data-export-types='["txt","excel"]' data-export-options='{
                            "fileName": "students-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    
                                    <th  data-field="id" data-sortable="true">ID</th>
                                    <th  data-field="brand" data-sortable="true">Brand</th>
                                    <th data-field="size" data-sortable="true">Size</th>
                                    <th data-field="wheel" data-sortable="true">Wheel Type</th>
                                    <th  data-field="pattern" data-sortable="true">Pattern</th>
                                    <th  data-field="tyre_type" data-sortable="true">Tyre Type</th>
                                    <th  data-field="amount" data-sortable="true">Amount</th>
                                    <th  data-field="delivery_charges" data-sortable="true">Delivery Charges</th>
                                    <th  data-field="fitting_charges" data-sortable="true">Fitting Charges</th>
                                    <th  data-field="actual_price" data-sortable="true">Actual Price</th>
                                    <th  data-field="final_price" data-sortable="true">Final Price</th>
                                    <th  data-field="image">Image</th>
                                    <th  data-field="status" data-sortable="true">Stock</th>
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
    $('#seller_id').on('change', function() {
        $('#products_table').bootstrapTable('refresh');
    });
    $('#community').on('change', function() {
        $('#users_table').bootstrapTable('refresh');
    });

    function queryParams(p) {
        return {
            "category_id": $('#category_id').val(),
            "seller_id": $('#seller_id').val(),
            "community": $('#community').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>