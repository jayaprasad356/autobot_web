<section class="content-header">
    <h1>
        Battery Orders /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
</h1>
    
</section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <h4 class="box-title">Filter by Ordered Date </h4><br>
                                    <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"/>
                                </div>
                            </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='users_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=battery_orders" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-export-options='{
                            "fileName": "orders-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="mobile" data-sortable="true">Mobile</th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="brand" data-sortable="true">Brand</th>
                                    <th data-field="type" data-sortable="true">Battery Type</th>
                                    <th data-field="warranty" data-sortable="true">Warranty</th>
                                    <th data-field="price" data-sortable="true">Price</th>
                                    <th data-field="quantity" data-sortable="true">Quantity</th>
                                    <th data-field="grand_total" data-sortable="true">Grand Total</th>
                                    <th data-field="order_date" data-sortable="true">Order Date</th>
                                    <th data-field="image">Image</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="operate">Action</th>
                    
                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="separator"> </div>
        </div>
        <!-- /.row (main row) -->
    </section>
<script>

    $('#date').on('change', function() {
        id = $('#date').val();
        $('#users_table').bootstrapTable('refresh');
    });
   

    function queryParams(p) {
        return {
            "date": $('#date').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }

</script>