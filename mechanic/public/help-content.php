<section class="content-header">
    <h1>
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>

</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <h2>Autobot Help Desk</h2>
        <p>Description of content here</p>
        <div class="separator"> </div>
    </div>
    <!-- /.row (main row) -->
</section>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const offerid = urlParams.get('id')
    function queryParams(p) {
        return {
            "offerid": offerid,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
