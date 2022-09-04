<section class="content-header">
    <h1>
        Used Vehicles <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-used_vehicle.php"><i class="fa fa-plus-square"></i> Add Used Vehicle</a>
    </ol>
    
</section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='users_table' class="table table-hover" data-toggle="table" data-url="get-bootstrap-table-data.php?table=used_vehicles" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-options='{
                            "fileName": "users-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="brand" data-sortable="true">Brand</th>
                                    <th data-field="bike_name" data-sortable="true">Bike Name</th>
                                    <th data-field="model" data-sortable="true">Model</th>
                                    <th data-field="vehicle_no" data-sortable="true">Vehicle Number</th>
                                    <th data-field="km_driven" data-sortable="true">Km Driven</th>
                                    <th data-field="insurance" data-sortable="true">Insurance</th>
                                    <th data-field="price" data-sortable="true">Price</th>
                                    <th data-field="location" data-sortable="true">Location</th>
                                    <th data-field="color" data-sortable="true">Color</th>
                                    <th data-field="fuel" data-sortable="true">Fuel</th>
                                    <th data-field="owner" data-sortable="true">Owner</th>
                                    <th data-field="image">Image</th>
                                    <th  data-field="operate" data-events="actionEvents">Action</th>   
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

