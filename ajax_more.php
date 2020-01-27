<?php
if(!empty($_POST["id"])){
    // Include the database configuration file
    include 'dbConfig.php';
    // Count all records except already displayed
    $query = $db->query("SELECT COUNT(*) as num_rows FROM customers WHERE customerNumber < ".$_POST['id']." ORDER BY customerNumber DESC");

    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];

    $showLimit = 10;

    // Get records from the database
    $query = $db->query("SELECT * FROM customers WHERE customerNumber < ".$_POST['id']." ORDER BY customerNumber DESC LIMIT $showLimit");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $customerNumber = $row['customerNumber'];
            ?>
            <div class="list_item"><?php echo $row['customerName']; ?></div>
        <?php } ?>
        <?php if($totalRowCount > $showLimit){ ?>
            <div class="show_more_main" id="show_more_main<?php echo $customerNumber; ?>">
                <span id="<?php echo $customerNumber; ?>" class="show_more" title="Load more posts">Show more</span>
                <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
            </div>
        <?php } ?>
        <?php
    }
}